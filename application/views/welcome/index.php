<div class="btn-group">
  <a class="btn" href="#"><i class="icon-align-left"></i></a>
  <a class="btn" href="#"><i class="icon-align-center"></i></a>
  <a class="btn" href="#"><i class="icon-align-right"></i></a>
  <a class="btn" href="#"><i class="icon-align-justify"></i></a>
</div>

<div class="btn-group">
    <a class="btn btn-primary" href="#"><i class="icon-user"></i> User</a>
    <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="icon-caret-down"></span></a>
    <ul class="dropdown-menu">
        <li><a href="#"><i class="icon-pencil"></i> Edit</a></li>
        <li><a href="#"><i class="icon-trash"></i> Delete</a></li>
        <li><a href="#"><i class="icon-ban-circle"></i> Ban</a></li>
        <li class="divider"></li>
        <li><a href="#"><i class="i"></i> Make admin</a></li>
    </ul>
</div>

<input type="text" value="02-16-2012" id="datepicker">
<script>
$(document).ready(function(){
    $('#datepicker').datepicker({
    format: 'mm-dd-yyyy'
});
});
</script>
