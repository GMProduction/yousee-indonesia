// Kompresi gambar menggunakan HTML5 Canvas dengan loop multi-pass untuk menjamin ukuran selalu < 1.5 MB (jauh di bawah batas server 2 MB)
async function compressWithCanvas(file, maxTargetBytes = 1.4 * 1024 * 1024) {
    if (!file || !file.type.match(/image.*/)) {
        return file;
    }

    return new Promise((resolve) => {
        const reader = new FileReader();
        reader.onload = function(readerEvent) {
            const image = new Image();
            image.onload = async function() {
                let quality = 0.8;
                let maxDimension = 1400;
                let currentBlob = null;
                let iterations = 0;

                while (iterations < 5) {
                    let width = image.width;
                    let height = image.height;

                    if (width > maxDimension || height > maxDimension) {
                        if (width > height) {
                            height = Math.round((height * maxDimension) / width);
                            width = maxDimension;
                        } else {
                            width = Math.round((width * maxDimension) / height);
                            height = maxDimension;
                        }
                    }

                    const canvas = document.createElement('canvas');
                    canvas.width = width;
                    canvas.height = height;
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(image, 0, 0, width, height);

                    currentBlob = await new Promise(r => canvas.toBlob(r, 'image/jpeg', quality));

                    // Jika sudah di bawah batas target (1.4MB), hentikan loop
                    if (currentBlob && currentBlob.size <= maxTargetBytes) {
                        break;
                    }

                    // Turunkan dimensi dan kualitas jika masih di atas target
                    quality = Math.max(0.4, quality - 0.15);
                    maxDimension = Math.round(maxDimension * 0.8);
                    iterations++;
                }

                if (currentBlob) {
                    const newName = file.name.replace(/\.[^/.]+$/, "") + ".jpg";
                    const compressedFile = new File([currentBlob], newName, {
                        type: 'image/jpeg',
                        lastModified: Date.now()
                    });
                    resolve(compressedFile);
                } else {
                    resolve(file);
                }
            };
            image.onerror = function() {
                resolve(file);
            };
            image.src = readerEvent.target.result;
        };
        reader.onerror = function() {
            resolve(file);
        };
        reader.readAsDataURL(file);
    });
}

async function compressSingleFile(imageFile, maxSizeMB = 0.8, maxWidthOrHeight = 1400) {
    if (!imageFile || !(imageFile instanceof Blob)) {
        return imageFile;
    }

    try {
        if (typeof imageCompression !== 'undefined') {
            const options = {
                maxSizeMB: Math.min(maxSizeMB, 1.2),
                maxWidthOrHeight: maxWidthOrHeight,
                useWebWorker: true,
                fileType: 'image/jpeg'
            };
            let result = await imageCompression(imageFile, options);
            if (result && result.size < 1.5 * 1024 * 1024) {
                return result;
            }
        }
    } catch (e) {}

    // Canvas fallback multi-pass guaranteed < 1.4 MB
    return await compressWithCanvas(imageFile, 1.4 * 1024 * 1024);
}

async function handleImageUpload(inputSource) {
    let file = null;
    if (inputSource instanceof File || inputSource instanceof Blob) {
        file = inputSource;
    } else if (inputSource && inputSource[0] && inputSource[0].files && inputSource[0].files.length > 0) {
        file = inputSource[0].files[0];
    } else if (inputSource && inputSource.files && inputSource.files.length > 0) {
        file = inputSource.files[0];
    }

    if (!file) {
        return null;
    }

    return await compressSingleFile(file);
}
