document.addEventListener('DOMContentLoaded', function() {
    var fab = document.querySelector('.fab');
    var overlay = document.querySelector('.header-overlay-2');
    
    if (fab && overlay) {
      fab.addEventListener('click', function() {
        overlay.classList.toggle('active');
      });
    }
  });
 
// Lắng nghe sự kiện cuộn trang
window.addEventListener('scroll', function() {
    var btnScroll = document.getElementById('btn-scroll-top');
    if (btnScroll) {
        if (window.scrollY > 300) {
            btnScroll.classList.add('show');
        } else {
            btnScroll.classList.remove('show');
        }
    }
});

// Hàm cuộn mượt lên đầu trang
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}
 
// Hàm biến đổi Tiêu đề tiếng Việt có dấu thành mã Slug URL chuẩn SEO
function locdau(str) {
    if (!str) return '';
    
    // Chuyển về chuỗi chữ thường
    str = str.toLowerCase();

    // Xử lý toàn bộ ký tự tiếng Việt có dấu sang không dấu
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    str = str.replace(/đ/g, "db"); // Hoặc dùng "d" tùy theo sở thích URL của anh

    // Loại bỏ toàn bộ ký tự đặc biệt lạ, chỉ giữ lại chữ cái, chữ số và dấu cách
    str = str.replace(/[^a-z0-9\s-]/g, '');

    // Thay thế khoảng trắng trùng lặp hoặc dấu cách bằng một dấu gạch ngang đơn (-)
    str = str.replace(/[\s-]+/g, '-');

    // Xóa bỏ ký tự gạch ngang nằm thừa ở đầu hoặc cuối chuỗi
    str = str.replace(/^-+|-+$/g, '');

    return str;
}
	
function submitNewsletter(e) {
    e.preventDefault(); // Chặn hành vi submit load lại trang thô của HTML Form
    
    var emailInput = $('#js-nl-email').val().trim();
    var btnSubmit  = $('#js-nl-btn');
    
    if(emailInput === '') {
        alert('Vui lòng nhập địa chỉ email hợp lệ!');
        return false;
    }
    
    btnSubmit.prop('disabled', true).text('Đang xử lý...');
    
    $.ajax({
        url: BASE_URL + 'newsletter/register_email',
        type: 'POST',
        data: { txt_email: emailInput },
        dataType: 'json',
        success: function(response) {
            alert(response.message);
            if(response.status === 'success') {
                $('#js-nl-email').val(''); // Xóa trống ô input sau khi đăng ký thành công
            }
        },
        error: function() {
            alert('Hệ thống xử lý đăng ký bản tin gặp sự cố, vui lòng thử lại sau!');
        },
        complete: function() {
            btnSubmit.prop('disabled', false).text('Đăng ký');
        }
    });
}
	
function validateCustomerTicket() {
    const alertBox = document.getElementById('js-ticket-alert');
    const alertTxt = document.getElementById('js-ticket-alert-text');
    
    alertBox.style.display = 'none';

    const name    = document.getElementById('tf-name').value.trim();
    const email   = document.getElementById('tf-email').value.trim();
    const title   = document.getElementById('tf-title').value.trim();
    const desc    = document.getElementById('tf-desc').value.trim();
    const emailReg = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (name === '' || name.length < 5) {
        alertTxt.textContent = 'Vui lòng nhập Họ và tên đầy đủ hợp lệ (chứa ít nhất 5 ký tự)!';
        alertBox.style.display = 'block';
        return false;
    }
    if (email === '' || !emailReg.test(email)) {
        alertTxt.textContent = 'Địa chỉ Email không hợp lệ! Vui lòng nhập đúng định dạng để hệ thống gửi thông báo.';
        alertBox.style.display = 'block';
        return false;
    }
    if (title === '' || title.length < 8) {
        alertTxt.textContent = 'Vui lòng nhập Tiêu đề ngắn gọn mô tả sự cố (chứa ít nhất 8 ký tự)!';
        alertBox.style.display = 'block';
        return false;
    }
    if (desc === '' || desc.length < 15) {
        alertTxt.textContent = 'Vui lòng mô tả chi tiết vướng mắc đang gặp phải (chứa ít nhất từ 15 ký tự trở lên)!';
        alertBox.style.display = 'block';
        return false;
    }

    return true;
}

function toggleUserMenu() {
  const menu = document.getElementById('userDropdownMenu');
  const btnArrow = document.querySelector('.user-dropdown-btn .arrow-icon');
  
  menu.classList.toggle('show');
  
  // Xoay nhẹ mũi tên khi mở menu
  if (menu.classList.contains('show')) {
    btnArrow.style.transform = 'rotate(180deg)';
  } else {
    btnArrow.style.transform = 'rotate(0deg)';
  }
}

// Tự động đóng menu nếu click ra ngoài vùng dropdown
window.addEventListener('click', function(e) {
  const dropdown = document.querySelector('.user-profile-dropdown');
  if (dropdown && !dropdown.contains(e.target)) {
    const menu = document.getElementById('userDropdownMenu');
    const btnArrow = document.querySelector('.user-dropdown-btn .arrow-icon');
    
    if (menu && menu.classList.contains('show')) {
      menu.classList.remove('show');
      if (btnArrow) btnArrow.style.transform = 'rotate(0deg)';
    }
  }
});

// Tự động render dải màu nền động cho những tin không upload hình ảnh
document.addEventListener("DOMContentLoaded", function() {  
    const thumbBoxes = document.querySelectorAll('.thumb[data-gradient]');
    thumbBoxes.forEach(function(box) {
        const gradientStr = box.getAttribute('data-gradient');
        if (gradientStr) {
            box.style.background = gradientStr;
        }
    });
});

// Tu dong render dai mau nen động cho tin tuc
document.addEventListener("DOMContentLoaded", function() {   
    const newsThumbBoxes = document.querySelectorAll('.news-thumb[data-gradient]');
    newsThumbBoxes.forEach(function(box) {
        const gradientStr = box.getAttribute('data-gradient');
        if (gradientStr) {
            box.style.background = gradientStr;
        }
    });
});

// Tự động đọc dữ liệu đường dẫn ảnh từ thuộc tính data gán thay thế cho CSS inline
document.addEventListener("DOMContentLoaded", function() {    
    const galleryTiles = document.querySelectorAll('.g-tile[data-bg]');
    galleryTiles.forEach(function(tile) {
        const bgUrl = tile.getAttribute('data-bg');
        if (bgUrl) {
            tile.style.backgroundImage = "url('" + bgUrl + "')";
        }
    });
});

// Xử lý đóng mở Popup Iframe Google Maps qua nút inline mới
document.addEventListener("DOMContentLoaded", function() {
    const inlineMapsBtns = document.querySelectorAll('.btn-inline-maps');
    const mapsModal      = document.getElementById('js-maps-modal');
    const mapsBody       = document.getElementById('js-maps-body');
    const mapsCloseBtn   = document.getElementById('js-maps-close');

    inlineMapsBtns.forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const rawIframe = this.getAttribute('data-maps-raw');
            if (rawIframe) {
                mapsBody.innerHTML = rawIframe;
                mapsModal.classList.add('open');
            }
        });
    });

    mapsCloseBtn.addEventListener('click', function() {
        mapsModal.classList.remove('open');
        mapsBody.innerHTML = '';
    });

    mapsModal.addEventListener('click', function(e) {
        if (e.target === mapsModal) {
            mapsModal.classList.remove('open');
            mapsBody.innerHTML = '';
        }
    });
});

/* --- HOẠT ĐỘNG HERO BACKGROUND SLIDER --- */
document.addEventListener("DOMContentLoaded", function() {
    // Duyệt qua toàn bộ các item slide có cấu hình data-bg
    const slideItems = document.querySelectorAll('.slide-item[data-bg]');
    slideItems.forEach(function(item) {
        const bgUrl = item.getAttribute('data-bg');
        if (bgUrl) {
            item.style.backgroundImage = "url('" + bgUrl + "')";
        }
    });
});

  let currentSlideIndex = 0;
  const slides = document.querySelectorAll('.slide-item');
  const dots = document.querySelectorAll('.dot');
  let slideInterval = setInterval(nextSlide, 5000);

  function updateSlider() {
    slides.forEach(slide => slide.classList.remove('active'));
    dots.forEach(dot => dot.classList.remove('active'));
    if (slides[currentSlideIndex]) slides[currentSlideIndex].classList.add('active');
    if (dots[currentSlideIndex]) dots[currentSlideIndex].classList.add('active');
  }

  function nextSlide() {
    if (slides.length === 0) return;
    currentSlideIndex = (currentSlideIndex + 1) % slides.length;
    updateSlider();
  }

  function moveSlide(direction) {
    clearInterval(slideInterval);
    currentSlideIndex = (currentSlideIndex + direction + slides.length) % slides.length;
    updateSlider();
    slideInterval = setInterval(nextSlide, 5000);
  }

  function setSlide(index) {
    clearInterval(slideInterval);
    currentSlideIndex = index;
    updateSlider();
    slideInterval = setInterval(nextSlide, 5000);
  }

  /* --- HOẠT ĐỘNG POPUP LIGHTBOX GALLERY (CÓ NEXT/PREV ALBUM CON) --- */
let currentAlbumImages = [];
let currentImageIndex  = 0;
let currentAlbumCaption = '';

const modal = document.getElementById('customLightbox');
const modalImg = document.getElementById('lightboxTargetImg');
const modalCaption = document.getElementById('lightboxTargetCaption');
const modalCounter = document.getElementById('lightboxCounter');

function openGalleryLightbox(element) {
    try {
        const rawImages = element.getAttribute('data-images');
        currentAlbumImages = JSON.parse(rawImages);
    } catch(e) {
        currentAlbumImages = [];
    }

    // Nếu album không có danh sách ảnh con thì dùng ảnh background đại diện
    if (!currentAlbumImages || currentAlbumImages.length === 0) {
        const bgImgUrl = element.getAttribute('data-bg');
        if (bgImgUrl) currentAlbumImages = [bgImgUrl];
    }

    currentAlbumCaption = element.getAttribute('data-caption') || 'Hình ảnh dự án PICO';
    currentImageIndex   = 0;

    updateLightboxView();
    
    if (modal) {
        modal.classList.add('open');
        document.body.style.overflow = 'hidden'; 
    }
}

function updateLightboxView() {
    if (!currentAlbumImages || currentAlbumImages.length === 0) return;

    modalImg.src = currentAlbumImages[currentImageIndex];
    modalCaption.textContent = currentAlbumCaption;
    
    // Hiển thị chỉ số đếm ảnh (Ví dụ: 1 / 5)
    if (modalCounter) {
        if (currentAlbumImages.length > 1) {
            modalCounter.textContent = (currentImageIndex + 1) + ' / ' + currentAlbumImages.length;
            modalCounter.style.display = 'inline-block';
        } else {
            modalCounter.style.display = 'none';
        }
    }
}

function changeLightboxImage(direction) {
    if (!currentAlbumImages || currentAlbumImages.length <= 1) return;
    
    currentImageIndex = (currentImageIndex + direction + currentAlbumImages.length) % currentAlbumImages.length;
    updateLightboxView();
}

function forceCloseLightbox() {
    if (modal) {
        modal.classList.remove('open');
        document.body.style.overflow = '';
    }
}

function closeLightbox(event) {
    if (event.target === modal || event.target.classList.contains('lightbox-content-wrap')) {
        forceCloseLightbox();
    }
}

// BẮT SỰ KIỆN PHÍM BÀN PHÍM (ESC DỂ ĐÓNG, MŨI TÊN TRÁI/PHẢI ĐỂ CHUYỂN ẢNH)
document.addEventListener('keydown', function(event) {
    if (!modal || !modal.classList.contains('open')) return;

    if (event.key === 'Escape') {
        forceCloseLightbox();
    } else if (event.key === 'ArrowLeft') {
        changeLightboxImage(-1);
    } else if (event.key === 'ArrowRight') {
        changeLightboxImage(1);
    }
});

/* --- XỬ LÝ NÚT MOBILE MENU TOGGLE --- */
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const navLinks   = document.querySelector('.nav-links');
    
    if (menuToggle && navLinks) {
        menuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            navLinks.classList.toggle('active');
            
            // Đổi icon 3 gạch sang icon đóng X và ngược lại
            const icon = menuToggle.querySelector('i');
            if (icon) {
                if (navLinks.classList.contains('active')) {
                    icon.className = 'fa-solid fa-xmark';
                } else {
                    icon.className = 'fa-solid fa-bars';
                }
            }
        });

        // Tự động đóng menu khi click ra ngoài vùng nav
        document.addEventListener('click', function(e) {
            if (!navLinks.contains(e.target) && !menuToggle.contains(e.target)) {
                if (navLinks.classList.contains('active')) {
                    navLinks.classList.remove('active');
                    const icon = menuToggle.querySelector('i');
                    if (icon) icon.className = 'fa-solid fa-bars';
                }
            }
        });
    }
});