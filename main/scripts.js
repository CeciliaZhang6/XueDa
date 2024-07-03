// scripts.js
document.addEventListener('DOMContentLoaded', function() {
    const textElement = document.getElementById('animated-text');
    const texts = ["event holding", "studying", "chilling"];
    let index = 0;
    let charIndex = 0;
    let currentText = '';
    let isDeleting = false;

    function type() {
        if (charIndex < texts[index].length && !isDeleting) {
            currentText += texts[index][charIndex];
            charIndex++;
            textElement.textContent = currentText;
            setTimeout(type, 130); // 打字速度
        } else if (isDeleting && charIndex > 0) {
            currentText = texts[index].substring(0, charIndex - 1);
            charIndex--;
            textElement.textContent = currentText;
            setTimeout(type, 100); // 删除速度
        } else {
            isDeleting = !isDeleting;
            if (!isDeleting) {
                index = (index + 1) % texts.length;
            }
            setTimeout(type, 1200); // 等待/更换文字速度
        }
    }

    type();

    // Banner image and dots functionality
    const banners = ['pic/banner1.jpg', 'pic/banner2.jpg', 'pic/room3.jpg'];
    const dots = document.querySelectorAll('.dot');
    let bannerIndex = 0;

    function updateBanner(index) {
        document.querySelector('.banner').style.backgroundImage = `url(${banners[index]})`;
        dots.forEach(dot => dot.classList.remove('active'));
        dots[index].classList.add('active');
    }

    dots.forEach(dot => {
        dot.addEventListener('click', function() {
            bannerIndex = parseInt(this.getAttribute('data-index'));
            updateBanner(bannerIndex);
        });
    });

    function autoSlide() {
        bannerIndex = (bannerIndex + 1) % banners.length;
        updateBanner(bannerIndex);
        setTimeout(autoSlide, 10000);
    }

    // TODO: fix dot display for showing or not showing after clicking

    autoSlide();


    // display room items
    function fetchData(url){
        fetch(url).then(response => response.json()).then(data => {
            console.log(data);
        })
    }

    const url = "http://www.uccainc.com/csp1/roomAPI.php";
    
    fetchData(url);
});
