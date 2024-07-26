var root_url = "/home/uccaciyo/public_html/csp1/users/";
var cur_user = document.getElementById("cur_user");
var target_user =""; // the user 

document.addEventListener('DOMContentLoaded', function() {
    loadUserInfo();
    loadUserRooms(cur_user);
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

document.querySelector('.edit-profile-btn').addEventListener('click', function() {
    // TODO: edit profile
    console.log('Editing profile...');
});