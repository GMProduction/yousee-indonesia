async function compressSingleFile(imageFile, maxSizeMB = 0.8, maxWidthOrHeight = 1600) {
    if (!imageFile || !(imageFile instanceof Blob)) {
        return imageFile;
    }
    // Jika file sudah sangat kecil (< 300KB), tidak perlu dikompres
    if (imageFile.size < 300 * 1024) {
        return imageFile;
    }

    const options = {
        maxSizeMB: maxSizeMB,
        maxWidthOrHeight: maxWidthOrHeight,
        useWebWorker: true,
        fileType: imageFile.type === 'image/png' ? 'image/png' : 'image/jpeg'
    };

    try {
        if (typeof imageCompression !== 'undefined') {
            const compressedFile = await imageCompression(imageFile, options);
            return compressedFile;
        }
    } catch (error) {
        // Jika gagal kompres, kembalikan file original
    }
    return imageFile;
}

async function handleImageUpload(inputSource) {
    let files = [];
    if (inputSource instanceof File || inputSource instanceof Blob) {
        return await compressSingleFile(inputSource);
    } else if (inputSource && inputSource[0] && inputSource[0].files) {
        files = inputSource[0].files;
    } else if (inputSource && inputSource.files) {
        files = inputSource.files;
    }

    if (files.length === 0) {
        return null;
    }

    return await compressSingleFile(files[0]);
}
