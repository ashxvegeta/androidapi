<!DOCTYPE html>
<html>
<head>
  <title>PHP API Client</title>
  <meta charset="UTF-8" />
  <style>
    body { font-family: Arial; padding: 20px; }
    input, button { margin: 5px; }
    table, th, td { border: 1px solid black; border-collapse: collapse; padding: 5px; }
    .fa{
      cursor: pointer;
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <h1>Users List</h1>

  <table id="usersTable"></table>
  <h2>Add users</h2>
  <input type="hidden" id="userId" />
  <input type="text" name="name"  id= "name" placeholder="Name">
  <input type="text" name="email" id= "email"  placeholder="Email">
  <input type="number" name="age" id= "age"  placeholder="Age">
  <button  id="submitBtn" onclick="addusers()">Submit</button>



  <script>
    const API_URL = 'http://127.0.0.1:8000/api/users';


    function getUsers() {
    fetch(API_URL)
    .then(res=>res.json())
    .then(response=>{
        const table = document.getElementById('usersTable');
        table.innerHTML = '';
        if(response.data.length == 0){
            table.innerHTML = "<tr><td colspan='5'>No users found</td></tr>";
        }
        else{
            table.innerHTML = "<tr><th>ID</th><th>Name</th><th>Email</th><th>Age</th><th>Action</th></tr>";
        }
        response.data.forEach(user=>{
            const status = user.status == 1 ? 'Active' : 'Inactive';
      
            table.innerHTML +=`
            <tr>
              <td>${user.id}</td>
              <td>${user.name}</td>
              <td>${user.email}</td>
              <td>${user.age}</td>
                <td>
                    
               <button onclick="editUser(${user.id}, '${user.name}', '${user.email}', ${user.age})">Edit</button>
              <button onclick="toggleStatus(${user.id})">${status}</button>

                    <i class="fa fa-trash" onclick="deleteUser(${user.id})"></i>
            </tr>
          `;
        });
     });
     }



     function addusers() {
        const id = document.getElementById('userId').value;
         const name = document.getElementById('name').value;
         const email = document.getElementById('email').value;
         const age = document.getElementById('age').value;

         const method = id ? 'PUT' : 'POST';
         const url = id ? `${API_URL}/${id}` : API_URL;

         fetch(url,{
            method: method,
            headers:{
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body:JSON.stringify({
                name: name,
                email: email,
                age: age
            })
         }).then(response=>response.json())
         .then(response=>{
            alert(response.message);
            getUsers();
           
         })
         .catch(error=>{
            console.error('Error:', error);
         });
     }



     function deleteUser(id){
        fetch(`${API_URL}/${id}`,{

            method: 'DELETE',
            headers:{
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            }
        }).then(response=>response.json())
        .then(response=>{
            alert(response.message);
            getUsers();
        })
     }

        function editUser(id, name, email, age){
            document.getElementById('userId').value = id;
            document.getElementById('name').value = name;
            document.getElementById('email').value = email;
            document.getElementById('age').value = age;
            document.getElementById('submitBtn').innerText = 'Update';
        }



        function toggleStatus(id){
            fetch(`${API_URL}/${id}/toggle-status`,{
               method: 'PATCH',
                headers:{
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                }
            }).then(response=>response.json())
            .then(response=>{
                alert(response.message);
                getUsers();
            })
        }






   

    

   

   



    
   
    getUsers();
  </script>
</body>
</html>