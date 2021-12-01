<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<div>
  <nav class="navbar navbar-light bg-light">
    <div class="col-3">
    <a class="navbar-brand" href="#">
      <img src="../image/handysolver.png" width="170" height="140" alt="">
    </a>
    </div>
    <div class="col-9" align="center">
      <h1>To-do List Application</h1>
      <p>Where to-do item are added/deleted and belong to categories</p>
    </div>
  </nav>
<br>
  <form class="form-inline" style="margin-top: 50px; margin-left: 50px;">
    <div class="form-group mb-2">
      <select id="category">
        <option>Category</option>
          @foreach($categories as $category)
          <option value="{{$category->id}}" name="{{$category->name}}">{{$category->name}}</option>
          @endforeach
      </select>
    </div>
    <div class="form-group mx-sm-3 mb-2">
      <input type="text" class="form-control" id="todoname" placeholder="Type todo item name" />
    </div>
    <input type="button" id="add" value="Add" onClick=addTodo() class="btn btn-primary mb-2" />
  </form>
<br>
<br>
<br>
<div>
  <table class="table table-sm" id="table">
    <thead>
      <tr>
        <th scope="col">Todo item name</th>
        <th scope="col">Category</th>
        <th scope="col">Timestamp</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody id="todoList">
      
      @foreach($todos as $todo)
      
      <tr>
        <td scope="row">{{$todo->name}}</td>
        <td>{{$todo->category->name}}</td>
        <td>{{date('jS, F', strtotime($todo->created_at))}}</td>
        <td><a href="delete/{{$todo->id}}" class="btn btn-danger">Delete</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<script>

function addTodo(){
  // alert($('#category').val());

  let category = $('#category').val() ;
  let name = $('#todoname').val();

  $.ajax({
    url: '/api/todo/create',
    type: 'post',
    dataType: 'json',
    contentType: 'application/json',
    data: JSON.stringify({
      'category_id' : category,
      'name': name
    }),
    success: function(data){
      
      let html = `<tr><td scope="row">`+data.name+`</td>
        <td>`+data.category_name+`</td>
        <td>`+data.timestamp+`</td>
        <td><a href="delete/`+data.id+`" class="btn btn-danger">Delete</a></td></tr>`
      $("#todoList").prepend(html);

      $('#todoname').val('');
      $('#category option:selected').remove();
    }, 
    error: function (request, status, error) {
      alert('error');
    }
  });
}
</script>