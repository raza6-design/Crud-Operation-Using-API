
@extends('layout')
@section('title')
dashboard 
@endsection
@section('head')
My Dashboard    
@endsection
@section('sub-head')
Welcome , to my website......
@endsection
@section('content')
     <div class="table">
        <br>
        <div>
                <a type="button"  class="btn btn-primary" href="/addpost">Add New Post</a>

                <button type="button" class="btn btn-danger"  id="logout">Logout</button>
        </div>
          <br>
          <div id="tableData">
               
        </div>
    </div>
    {{-- Single Post Modal --}}
    <div class="modal fade" id="singlePostModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="singlePostModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="singlePostLabel">Detail Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" > Close </button>
                </div>
            </div>
        </div>
    </div>  
        {{-- Update Post Modal --}}
        <div class="modal fade" id="updatePostModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="updatePostModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-5" id="updatePostLabel">Update Post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="updateform">
                    <div class="modal-body">
                        <input type="hidden" id="postId" class="form-control" value="">
                        <b>Title</b><input type="text" id="postTitle" class="form-control" value="">
                        <b>Description</b><input type="text" id="postBody" class="form-control" value="">
                        <img id="showImage" width="80px" style="border-radius:15px; "><br>
                        <b>Update Image</b><input type="file" id="postImage" class="form-control" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" > Close </button>
                        <button type="submit" id="update" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div> 
<script>
    // Logout api code
    document.querySelector('#logout').addEventListener('click',function(){
        const token = localStorage.getItem('api_token');

        fetch('/api/logout',{
            method:'POST',
            headers:{
                'Authorization': ` Bearer ${token} `,
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            window.location.href = "http://localhost:8000/loginpage";
        });
    });

    // All Post fetch data code
    function loadData(){
        const token = localStorage.getItem('api_token');

        fetch('/api/posts',{
            method:'GET',
            headers:{
                'Authorization': ` Bearer ${token} `,
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log(data.data.posts);
            var allpost = data.data.posts;
            const tableData = document.querySelector('#tableData');
            var table = `<table>
                <thead >
                    <tr>
                        <th>Image</th>
                        <th >Title</th>
                        <th>Description</th>
                        <th>View</th>
                        <th>Delete</th>
                        <th>Update</th>
                    </tr>
                </thead> `;
                allpost.forEach(post => {
                    table += ` <tbody>
                    <tr>
                        <td> <img src="/uploads/${post.image}" alt="" srcset="" width="70px" style="border-radius:20px;"> </td>
                        <td>${post.title}</td>
                        <td>${post.description}</td>
                        <td><button type="button" class="btn btn-primary" data-bs-post="${post.id}" data-bs-toggle="modal" data-bs-target="#singlePostModal">View</button></td>
                        <td> <button onclick="deletePost(${post.id})" type="button" class="btn btn-danger"> Delete </button> </td>
                        <td><button type="button" class="btn btn-success" data-bs-post="${post.id}" data-bs-toggle="modal" data-bs-target="#updatePostModal">Update</button></td>
                    </tr>
                </tbody>`;
                });
               
                table += `</table>`;
                
                tableData.innerHTML = table;
        });
    }
    loadData();

    // Single Post fetch data code
    var singleModal = document.querySelector("#singlePostModal");
    if(singleModal ){
        singleModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget
            const modalBody = document.querySelector("#singlePostModal .modal-body");
            modalBody.innerHTML = "";
            const id = button.getAttribute('data-bs-post')
            const token = localStorage.getItem('api_token');

            fetch(`/api/posts/${id}`,{
                method:'GET',
                headers:{
                    'Authorization': ` Bearer ${token} `,
                    'Content-Type' : 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                const post = data.data.post[0];
                modalBody.innerHTML = `
                <b>Title:</b>${post.title}
                <br>
                <b>Description:</b>${post.description}
                <br>
                <b>Post Image:</b><br>
                <img style="width:150px;border-radius:15px;" src="http://localhost:8000/uploads/${post.image}" />
                `;

            });
        })
    }
     // Update Post fetch data code
     var updateModal = document.querySelector("#updatePostModal");
    if(updateModal ){
        updateModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget

            const id = button.getAttribute('data-bs-post')
            const token = localStorage.getItem('api_token');

            fetch(`/api/posts/${id}`,{
                method:'GET',
                headers:{
                    'Authorization': ` Bearer ${token} `,
                    'Content-Type' : 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                const post = data.data.post[0];
                document.querySelector("#postId").value = post.id;
                document.querySelector("#postTitle").value = post.title;
                document.querySelector("#postBody").value = post.description;
                document.querySelector("#showImage").src = `/uploads/${post.image}`;
            });
        })
    }
    // Update post update data code
    var form = document.querySelector("#updateform");
        form.onsubmit = async(e)=>{
            e.preventDefault();

        const token = localStorage.getItem('api_token');
        const id = document.querySelector("#postId").value;
        const title = document.querySelector("#postTitle").value;
        const description = document.querySelector("#postBody").value;

        var formData = new FormData();
        formData.append('id',id);
        formData.append('title',title);
        formData.append('description',description);

        if(!document.querySelector("#postImage").files[0] ==""){
        const image = document.querySelector("#postImage").files[0];
        formData.append('image',image);
        }

        let response = await fetch(`/api/posts/${id}`,{
            method: 'POST',
            body: formData,
            headers:{
                'Authorization': `Bearer ${token}`,
                'X-HTTP-Method-Override' : 'PUT'
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            window.location.href = "http://localhost:8000/dashboard";
        });
        }
        // Delete Post
        async function deletePost(postId) {

        const token = localStorage.getItem('api_token');
        
        let response = await fetch(`/api/posts/${postId}`,{
            method: 'Delete',
            headers:{
                'Authorization': `Bearer ${token}`,
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            window.location.href = "http://localhost:8000/dashboard";
        });
        }
</script>
@endsection

       