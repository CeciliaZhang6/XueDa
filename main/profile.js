var root_url = "http://www.uccainc.com/csp1/users/";
var cur_user = document.getElementById("cur_user").innerHTML;
var target_user =""; // the user 

console.log("a=========>", cur_user);

document.addEventListener('DOMContentLoaded', function() {
    loadUserInfo();
    loadUserRooms(cur_user);

    const editProfileBtn = document.querySelector('.edit-profile-btn');
    const updateProfileForm = document.querySelector('.update-profile');
    const cancelBtn = document.querySelector('.cancel-btn');
    const updateForm = document.getElementById('update-form');

    editProfileBtn.addEventListener('click', function() {
        updateProfileForm.style.display = 'block';
    });

    cancelBtn.addEventListener('click', function() {
        updateProfileForm.style.display = 'none';
    });

    updateForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const username = document.getElementById('username').value;
        const bio = document.getElementById('bio').value;

        // Update the displayed info
        document.getElementById('display-username').textContent = username;
        document.getElementById('display-bio').textContent = bio;

        // Hide the form
        updateProfileForm.style.display = 'none';
    });
});

function loadUserInfo() {
    // TODO: fetch user info
    console.log('Loading user info...');
}

function loadUserRooms(email) {
    // TODO: fetch user's rooms
    console.log('Loading user rooms...');
    var url = root_url.concat(email, "/rooms/user_post_api.json");
    console.log(url);
    console.log("start fetching...");
    
    fetch(url).then(response => response.json()).then(data => {
        // data is the entire json file
        const container = document.getElementById('rooms-list');

        if (data.length > 0) {
            data.forEach(room => {
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

                // append h3, p, and button to room-info div
                roomInfoDiv.appendChild(h3);
                roomInfoDiv.appendChild(p);
                roomInfoDiv.appendChild(button);

                // append img and room-info div to the main div
                roomItemDiv.appendChild(img);
                roomItemDiv.appendChild(roomInfoDiv);

                // append the main div to the container
                container.appendChild(roomItemDiv);
            });
        } else {
            container.textContent = 'No data found';
        }
        
    })
}

// function loadRecentActivity() {
//     // TODO: fetch recent activity
//     console.log('Loading recent activity...');
// }
