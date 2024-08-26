var root_url = "http://www.uccainc.com/csp1/users/";
var cur_user = document.getElementById("cur_user").innerHTML;
var target_user =""; // the user (TODO: allow viewing other user's profile)

console.log("a=========>", cur_user);

document.addEventListener('DOMContentLoaded', function() {
    loadUserRooms(cur_user);

    const editProfileBtn = document.querySelector('.edit-profile-btn');
    const accountInfoDisplay = document.getElementById('account-info-display');
    const accountInfoEdit = document.getElementById('account-info-edit');
    const cancelBtnProfile = document.getElementById('cancel-btn-profile');
    const cancelBtnPost = document.getElementById('cancel-btn-post');
    const dimView = document.getElementById('dim-background');
    const editPost = this.documentElement.getElementById('edit-post-btn');

    editProfileBtn.addEventListener('click', function() {
        accountInfoDisplay.style.display = 'none';
        accountInfoEdit.style.display = 'block';
    });

    cancelBtnProfile.addEventListener('click', function() {
        accountInfoDisplay.style.display = 'block';
        accountInfoEdit.style.display = 'none';
    });

    editPost.addEventListener('click', function() {
        dimView.style.display = 'block';
    });

    cancelBtnPost.addEventListener('click', function() {
        dimView.style.display = 'none';
    });

});

function loadUserRooms(email) {
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

                // p description
                const p = document.createElement('p');
                p.textContent = room.description;

                // room id
                const roomID = document.createElement('p');
                roomID.textContent = room.id;
                roomID.style.display = none;
                roomID.setAttribute("room-id", room.id);

                // join button
                const joinButton = document.createElement('a');
                joinButton.textContent = 'Join';
                joinButton.href = room.link;
                joinButton.classList.add('button');
                
                // room actions div
                const roomActionsDiv = document.createElement('div');
                roomActionsDiv.classList.add('room-actions');

                // edit button
                const editBtn = document.createElement('button');
                editBtn.textContent = "edit";
                editBtn.classList.add("update-btn");
                editBtn.setAttribute("edit-post-btn", "edit");

                // // update form
                // const updateForm = document.createElement('form');
                // updateForm.method = 'POST';
                // updateForm.action = 'update_post.php'; 
                
                // const updateInput = document.createElement('input');
                // updateInput.type = 'hidden';
                // updateInput.name = 'room_id';
                // updateInput.value = room.id;

                // const updateButton = document.createElement('button');
                // updateButton.type = 'submit';
                // updateButton.textContent = 'Update';
                // updateButton.classList.add('update-room-btn');
                // updateForm.appendChild(updateInput);
                // updateForm.appendChild(updateButton);

                // delete form
                const deleteForm = document.createElement('form');
                deleteForm.method = 'POST';
                deleteForm.action = 'delete_post.php'; 
                deleteForm.target = 'self';
                
                const deleteInput = document.createElement('input');
                deleteInput.type = 'hidden';
                deleteInput.name = 'room_id';
                deleteInput.value = room.id;

                const deleteButton = document.createElement('button');
                deleteButton.type = 'submit';
                deleteButton.textContent = 'Delete';
                deleteButton.classList.add('delete-room-btn');

                deleteForm.appendChild(deleteInput);
                deleteForm.appendChild(deleteButton);

                // append forms to room actions div
                roomActionsDiv.appendChild(editBtn);
                roomActionsDiv.appendChild(deleteForm);

                // append all elements to room-info div
                roomInfoDiv.appendChild(h3);
                roomInfoDiv.appendChild(host);
                roomInfoDiv.appendChild(p);
                roomInfoDiv.appendChild(roomID);
                roomInfoDiv.appendChild(joinButton);
                roomInfoDiv.appendChild(roomActionsDiv);

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
