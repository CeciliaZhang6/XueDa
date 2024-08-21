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
    const banners = ['http://www.uccainc.com/csp1/pic/banner1.jpg', 'http://www.uccainc.com/csp1/pic/banner2.jpg', 'http://www.uccainc.com/csp1/pic/banner3.jpg'];
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

    const searchInput = document.getElementById('search-input');
    const container = document.getElementById('rooms-list');

    // display room items
    function fetchData(url, query = ''){
        fetch(url).then(response => response.json()).then(data => {
            // data is the entire json file
            const filteredRooms = data.filter( room => 
                room.title.toLowerCase().includes(query) ||
                room.description.toLowerCase().includes(query) ||
                room.host_name.toLowerCase.includes(query)
            );

            container.innerHTML = '';

            if (filteredRooms.length > 0) {
                filteredRooms.forEach(room => {
                    console.log("start fetching");

                    // room-item
                    const roomItemDiv = document.createElement('div');
                    roomItemDiv.classList.add('room-item');

                    // img
                    const img = document.createElement('img');
                    img.src = 'https://via.placeholder.com/150'; // Placeholder image
                    img.alt = room.title;

                    // room-info
                    const roomInfoDiv = document.createElement('div');
                    roomInfoDiv.classList.add('room-info');

                    // h3 title
                    const h3 = document.createElement('h3');
                    h3.textContent = room.title;

                    // host email
                    const host = document.createElement('p');
                    host.textContent = room.host_id;

                    // p description
                    const p = document.createElement('p');
                    p.textContent = room.description;

                    // join button
                    const button = document.createElement('a');
                    button.textContent = 'Join';
                    button.href = room.link;
                    button.classList.add('button');

                    const roomId = document.createElement('p');
                    roomId.textContent = room.id;
                    roomId.style.display = 'none';
                    roomId.id = "room_id";

                    // append h3, p, and button to room-info div
                    roomInfoDiv.appendChild(h3);
                    roomInfoDiv.appendChild(p);
                    roomInfoDiv.appendChild(button);

                    // append img and room-info div to the main div
                    roomItemDiv.appendChild(img);
                    roomItemDiv.appendChild(roomInfoDiv);
                    roomItemDiv.appendChild(roomId); // hidden id

                    // append the main div to the container
                    container.appendChild(roomItemDiv);
                });
            } else {
                container.textContent = 'No rooms found';
            }
            
        })
        .catch(error => {
            console.error("Error fetching data:", error);
        });
    }

    const url = "http://www.uccainc.com/csp1/roomAPI.php";

    fetchData(url);

    searchInput.addEventListener('input', function(){
        const query = searchInput.ariaValueMax.toLocaleLowerCase();
        fetchData(url, query);
    });

    function updateNavBar() {
        const usernameSpan = document.getElementById('username').innerHTML;
        const loginSignup = document.getElementById('login-signup');
        const viewProfile = document.getElementById('view-profile');
        const logout = document.getElementById('logout');

        if (usernameSpan !== 'guest') {
            console.log("status: user is logged in");
            loginSignup.style.display = 'none';
            viewProfile.style.display = 'inline-block';
            logout.style.display = 'inline-block';
        } else {
            console.log("status: guest mode");
            loginSignup.style.display = 'inline-block';
            viewProfile.style.display = 'none';
            logout.style.display = 'none';
        }
    }

    updateNavBar();
});
