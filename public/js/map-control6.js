var map_container;
var map_container_single;
var center_indonesia = { lat: -0.4029326, lng: 110.5938779 };

var s_provinsi = localStorage.getItem("s_provinsi") || "";
var s_kota = localStorage.getItem("s_kota") || "";
var s_tipe = localStorage.getItem("s_tipe") || "";
var s_posisi = localStorage.getItem("s_posisi") || "";

var IMG_BASE =
    location.protocol === "https:"
        ? "https://internal.yousee-indonesia.com"
        : "http://internal.yousee-indonesia.com";

function escapeHtml(str) {
    if (str == null) return "";
    return String(str)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#39;");
}

function normalizeImageUrl(raw) {
    if (!raw) return { primary: "", alt: "" };
    raw = String(raw).trim();

    if (/^https?:\/\//i.test(raw)) {
        var isHttp = raw.startsWith("http://");
        return {
            primary:
                isHttp && location.protocol === "https:"
                    ? raw.replace("http://", "https://")
                    : raw,
            alt: isHttp ? raw : raw.replace("https://", "http://"),
        };
    }

    if (raw.startsWith("//")) {
        return {
            primary:
                (location.protocol === "https:" ? "https:" : "http:") + raw,
            alt: (location.protocol === "https:" ? "http:" : "https:") + raw,
        };
    }

    var joined = raw.startsWith("/") ? IMG_BASE + raw : IMG_BASE + "/" + raw;
    return {
        primary:
            joined.startsWith("http://") && location.protocol === "https:"
                ? joined.replace("http://", "https://")
                : joined,
        alt: joined.startsWith("https://")
            ? joined.replace("https://", "http://")
            : joined.replace("http://", "https://"),
    };
}

async function fetchImageFromScraper(slug) {
    try {
        if (!slug) return null;
        var res = await fetch("/scraper.php?slug=" + encodeURIComponent(slug), {
            cache: "no-store",
        });
        if (!res.ok) throw new Error("HTTP " + res.status);
        var json = await res.json();
        if (json && json.imgUrl) {
            var pair = normalizeImageUrl(json.imgUrl);
            return pair.primary || pair.alt || null;
        }
    } catch (e) {
        console.warn("[scraper.php] gagal:", e);
    }
    return null;
}

function getFallbackImageFromPayload(d) {
    var raw = d.image3 || d.image2 || d.image1 || "";
    var pair = normalizeImageUrl(raw);
    return pair.primary || pair.alt || "";
}

function initMap() {
    var myLatLng = { lat: -7.5589494045543475, lng: 110.85658809673708 };
    map_container = new google.maps.Map(document.getElementById("main-map"), {
        zoom: 11,
        center: myLatLng,
        streetstreetViewControl: false,
    });
    generateGoogleMapData();
}

async function generateGoogleMapData() {
    try {
        $("#loading").show();
        var progressBar = $("#progress-bar");
        var progress = 0;
        var interval = setInterval(function () {
            if (progress < 90) {
                progress += 10;
                progressBar.css("width", progress + "%").text(progress + "%");
            }
        }, 300);

        var params = {
            province: localStorage.getItem("s_provinsi") || "",
            city: localStorage.getItem("s_kota") || "",
            type: localStorage.getItem("s_tipe") || "",
            position: localStorage.getItem("s_posisi") || "",
        };
        var queryString = $.param(params);
        var response = await $.get("/map/data?" + queryString);
        var payload = response["payload"] || [];

        clearInterval(interval);
        progressBar.css("width", "100%").text("100%");

        var filteredPayload = payload.filter(function (item) {
            var a = item.latitude,
                b = item.longitude;
            return a >= -11.0 && a <= 6.1 && b >= 95.0 && b <= 141.0;
        });

        removeMultiMarker();
        if (filteredPayload.length > 0) {
            currentPage = 1;
            await createGoogleMapMarker(filteredPayload);
            updateListTitik(filteredPayload);
        }
    } catch (e) {
        console.log(e);
    } finally {
        setTimeout(function () {
            $("#loading").hide();
        }, 500);
    }
}

let currentPage = 1;
const itemsPerPage = 12;

function updateListTitik(titik) {
    var listTitikContainer = $(".list-titik");
    listTitikContainer.empty();

    var totalItems = titik.length;
    var totalPages = Math.ceil(totalItems / itemsPerPage);
    var start = (currentPage - 1) * itemsPerPage;
    var end = start + itemsPerPage;
    var paginatedItems = titik.slice(start, end);
    var currentLocale = window.location.pathname.split("/")[1];

    paginatedItems.forEach(function (d) {
        var img = normalizeImageUrl("" + (d.image2 || "")).primary || "";
        listTitikContainer.append(
            '<a class="card-article" href="/' +
                currentLocale +
                "/listing/" +
                d.slug +
                '">' +
                '  <img src="' +
                escapeHtml(img) +
                '" />' +
                '  <div style="position:absolute;top:50%;right:0;transform:translateY(-50%);background-color:green;padding:2px 10px;border-radius:5px 0 0 5px;font-size:.8rem;color:white;">' +
                escapeHtml((d.type && d.type.name) || "-") +
                "</div>" +
                '  <div class="article-content"><div class="article-wrapper">' +
                '    <p class="title mt-2">' +
                escapeHtml(
                    (d.city && d.city.province && d.city.province.name) || ""
                ) +
                "</p>" +
                '    <p class="time">' +
                escapeHtml((d.city && d.city.name) || "") +
                "</p>" +
                '    <p class="alamat">' +
                escapeHtml(d.address || "") +
                "</p>" +
                "    <hr>" +
                "  </div></div>" +
                "</a>"
        );
    });

    var paginationContainer = $("#pagination");
    paginationContainer.empty();
    if (currentPage > 1)
        paginationContainer.append(
            '<a href="#" class="prev-next" id="prev-page">Prev</a>'
        );

    var isMobile = window.innerWidth <= 540;
    var pageStart = isMobile
        ? Math.max(1, currentPage - 2)
        : Math.max(1, currentPage - 4);
    var pageEnd = isMobile
        ? Math.min(totalPages, pageStart + 2)
        : Math.min(totalPages, pageStart + 4);

    for (let i = pageStart; i <= pageEnd; i++) {
        const pageItem = $(
            '<a href="#" class="page-link ' +
                (i === currentPage ? "active" : "") +
                '">' +
                i +
                "</a>"
        );
        pageItem.on("click", function (e) {
            e.preventDefault();
            currentPage = i;
            updateListTitik(titik);
        });
        paginationContainer.append(pageItem);
    }
    if (currentPage < totalPages)
        paginationContainer.append(
            '<a href="#" class="prev-next" id="next-page">Next</a>'
        );

    $("#prev-page").on("click", function (e) {
        e.preventDefault();
        if (currentPage > 1) {
            currentPage--;
            updateListTitik(titik);
        }
    });
    $("#next-page").on("click", function (e) {
        e.preventDefault();
        if (currentPage < totalPages) {
            currentPage++;
            updateListTitik(titik);
        }
    });
}

var multi_marker = [];

function removeMultiMarker() {
    for (var i = 0; i < multi_marker.length; i++) {
        multi_marker[i].setMap(null);
    }
    multi_marker = [];
}

function createGoogleMapMarker(payload) {
    return new Promise(function (resolve) {
        var bounds = new google.maps.LatLngBounds();

        payload.forEach(function (v, k) {
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(v["latitude"], v["longitude"]),
                map: map_container,
                icon:
                    v["type"] && v["type"]["icon"]
                        ? v["type"]["icon"]
                        : undefined,
                title: v["name"],
            });

            multi_marker.push(marker);

            var infowindow = new google.maps.InfoWindow({
                content: windowContent(v, k),
                pixelOffset: new google.maps.Size(0, -20),
            });

            marker.addListener("click", function () {
                infowindow.open({
                    anchor: marker,
                    map: map_container,
                    shouldFocus: false,
                });

                google.maps.event.addListenerOnce(
                    infowindow,
                    "domready",
                    function () {
                        (async function () {
                            var imgEl = document.getElementById("iw-img-" + k);
                            var loader = document.getElementById(
                                "iw-loader-" + k
                            );
                            if (!imgEl) return;

                            imgEl.addEventListener("load", function () {
                                this.style.opacity = "1";
                                if (loader) loader.style.display = "none";

                                var wrap = this.closest(".iw-img-wrap");
                                if (
                                    wrap &&
                                    this.naturalWidth &&
                                    this.naturalHeight
                                ) {
                                    wrap.style.aspectRatio =
                                        this.naturalWidth +
                                        " / " +
                                        this.naturalHeight;
                                }
                            });

                            var finalUrl = null;
                            try {
                                if (v.slug)
                                    finalUrl = await fetchImageFromScraper(
                                        v.slug
                                    );
                            } catch (e) {}
                            if (!finalUrl)
                                finalUrl = getFallbackImageFromPayload(v);

                            if (finalUrl) imgEl.src = finalUrl;
                            else if (loader)
                                loader.innerText = "Gambar tidak tersedia";
                        })();

                        var btn = document.getElementById("iw-cart-" + k);
                        if (btn) {
                            btn.addEventListener("click", function () {
                                var id = v.id || v.slug || v.name || "";
                                var address = v.address || v.location || "";
                                var slug = v.slug || "";
                                if (typeof window.addToCart === "function")
                                    window.addToCart(id, address, slug);
                                if (typeof window.toggleCart === "function")
                                    window.toggleCart();
                            });
                        }
                    }
                );
            });

            bounds.extend(marker.getPosition());
        });

        map_container.fitBounds(bounds);
        resolve();
    });
}

function windowContent(data, key) {
    var pathSegments = window.location.pathname.split("/");
    var lang = pathSegments[1] || "id";
    var title = data["location"] || data["name"] || "-";
    var address = data["address"] || "";
    var detailUrl = "/" + lang + "/listing/" + data["slug"];

    return `
  <div style="
      max-width:92vw;
      width:360px;
      max-height:65vh;
      overflow-y:auto;
      box-sizing:border-box;
      text-align:center;
  ">
    <!-- Wrapper gambar -->
    <div class="iw-img-wrap"
         style="
            position:relative;
            width:100%;
            aspect-ratio:16/9;
            background:#f1f5f9;
            border-radius:10px;
            overflow:hidden;
            margin:0 auto 12px auto;
            display:flex;
            align-items:center;
            justify-content:center;
         ">
      <div id="iw-loader-${key}"
           style="position:absolute;color:#64748B;font-size:12px;">Loading...</div>

      <img id="iw-img-${key}" alt="Gambar"
           style="
              width:100%;
              height:100%;
              object-fit:contain;
              object-position:center;
              border-radius:10px;
              opacity:0;
              transition:opacity .25s ease;
           "/>
    </div>

    <!-- Judul & alamat -->
    <div style="font-weight:800;font-size:clamp(16px,4vw,20px);margin-bottom:6px">
      ${escapeHtml(title)}
    </div>
    <div style="color:#64748B;font-size:clamp(12px,3vw,14px);margin-bottom:14px">
      ${escapeHtml(address)}
    </div>

    <!-- Tombol aksi -->
    <div style="
        display:flex;
        gap:10px;
        flex-wrap:wrap;
        justify-content:center
    ">
      <a href="${detailUrl}" target="_blank" rel="noopener"
         style="background:#1d4ed8;color:#fff;border-radius:10px;
                padding:10px 14px;text-decoration:none;font-weight:700;
                font-size:clamp(12px,3vw,14px)">
         Lihat Detail
      </a>
      <button id="iw-cart-${key}"
         style="background:#facc15;color:#fff;border:0;border-radius:10px;
                padding:10px 14px;font-weight:700;cursor:pointer;
                font-size:clamp(12px,3vw,14px)">
         🛒 + Keranjang
      </button>
    </div>
  </div>`;
}

async function openDetail(element) {
    event.preventDefault();
    var id = element.dataset.id;
    await generateSingleGoogleMapData(id);
    $("#simple-modal-detail").modal("show");
}

async function generateSingleGoogleMapData(id) {
    try {
        var payload = id;
        if (typeof id === "string") {
            var response = await $.get("/map/data/" + id);
            payload = response.payload;
        } else {
            if (typeof getUrl === "function") {
                var url = await getUrl(id.id);
                payload.url = url;
            }
        }

        var location = { lat: payload["latitude"], lng: payload["longitude"] };
        map_container_single = new google.maps.Map(
            document.getElementById("single-map-container"),
            {
                zoom: 16,
                center: location,
            }
        );
        new google.maps.Marker({
            position: new google.maps.LatLng(
                payload["latitude"],
                payload["longitude"]
            ),
            map: map_container_single,
            icon:
                payload["type"] && payload["type"]["icon"]
                    ? payload["type"]["icon"]
                    : undefined,
            title: payload["name"],
        });
        generateDetail(payload);
    } catch (e) {
        console.log(e);
    }
}

function generateDetail(data) {
    $("#detail-title-tipe").html(data["type"]["name"]);
    $("#detail-title-nama").html("( " + data["name"] + " )");
    $("#detail-vendor").val(
        data["vendor_all"]["name"] + " (" + data["vendor_all"]["brand"] + ")"
    );
    $("#detail-vendor-address").val(data["vendor_all"]["address"]);
    $("#detail-vendor-email").val(data["vendor_all"]["email"]);
    $("#detail-vendor-phone").val(data["vendor_all"]["picPhone"]);
    $("#detail-vendor-phone-pic").val(data["vendor_all"]["picPhone"]);
    $("#detail-vendor-pic").val(data["vendor_all"]["picName"]);
    $("#detail-provinsi").val(data["city"]["province"]["name"]);
    $("#detail-kota").val(data["city"]["name"]);
    $("#detail-alamat").val(data["address"]);
    $("#detail-lokasi").val(data["location"]);
    $("#detail-coordinate").val(data["latitude"] + ", " + data["longitude"]);
    $("#detail-tipe").val(data["type"]["name"]);
    $("#detail-posisi").val(data["position"]);
    $("#detail-panjang").val(data["height"]);
    $("#detail-lebar").val(data["width"]);
    $("#detail-qty").val(data["qty"]);
    $("#detail-side").val(data["side"]);
    $("#detail-trafic").val(data["trafic"]);
    $("#single-map-container-street-view").html(data["url"]);

    var f1 = normalizeImageUrl(data["image1"] || "").primary;
    var f2 = normalizeImageUrl(data["image2"] || "").primary;
    var f3 = normalizeImageUrl(data["image3"] || "").primary;

    $("#detail-gambar-1").attr("src", f1 || f2 || f3 || "");
    $("#detail-gambar-2").attr("src", f2 || f1 || f3 || "");
    $("#detail-gambar-3").attr("src", f3 || f2 || f1 || "");

    $("#link-gbr1").attr("href", f1 || "#");
    $("#dwnld-gbr1").attr({ href: f1 || "#", download: f1 || "" });
    $("#link-gbr2").attr("href", f2 || "#");
    $("#dwnld-gbr2").attr({ href: f2 || "#", download: f2 || "" });
    $("#link-gbr3").attr("href", f3 || "#");
    $("#dwnld-gbr3").attr({ href: f3 || "#", download: f3 || "" });

    var picPhone = (data["vendor_all"]["picPhone"] || "")
        .split("/")[0]
        .split(" ")
        .join("");
    if (picPhone && picPhone[0] === "0")
        picPhone = "62" + picPhone.substring(1);
    var text =
        "Apakah " +
        data["type"]["name"] +
        " yang berlokasi di " +
        (data["city"]["name"] || "") +
        " " +
        (data["address"] || "") +
        " " +
        (data["location"] || "") +
        " tersedia ?";
    $(".sendWa")
        .attr("href", "https://wa.me/" + picPhone + "?text=" + encodeURI(text))
        .attr("target", "_blank");
}
