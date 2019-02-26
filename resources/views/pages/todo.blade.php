@extends('layouts.main')
@section('title', 'To Do')
@section('menu')
    {!! $menu !!}
@endsection

@section('content')

<div class="row gtr-uniform">
   <div class="col-12 col-12-xsmall">
        <div class="form-title">
            <a href="{{URL('/')}}/todo/create" style="float:right; margin: 1em;" class="button primary small">
                <i class="fa fa-plus"></i> Add
            </a>
            <br>
            <br>
        </div>
        <div class="form-body">
            <table class="table table-bordered ui celled" id="table_id">
                <thead>
                    <tr>
                        <th>Task</th>
                        <th>Remarks</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Completed Date</th>
                        <th>Deleted Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('page-script')
<script>
$(function(){
    <?php
    if(isset($_POST['task'])):
    ?>
    var task_id = <?= $_POST['task']; ?>;
    <?php
    else: 
    ?>
    var task_id = 0;
    <?php
    endif;
    ?>

    fetchTodo(task_id);

});

function fetchTodo(task_id){
    var table = $('#table_id').DataTable();
    table.destroy();
    var table = $('#table_id').DataTable( {
        "order": [],
        // "bPaginate": false,
        // "processing": true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pageLength', className: 'button small',
                title: 'Todo List as of {{date('M d, Y')}}'
            },
            {
                extend: 'excelHtml5', className: 'button small',
                title: 'Todo List as of {{date('M d, Y')}}'
            },
            {
                extend: 'pdfHtml5', className: 'button small',
                title: 'Todo List as of {{date('M d, Y')}}'
            },
            {
                extend: 'print', className: 'button small',
                title: 'Todo List as of {{date('M d, Y')}}'
            },
        ],
        responsive: true,
        "ajax": {
            "url": "{{URL('/')}}/todo/fetchTodo",
            "type": "POST",
            "data" : {
                "_token": "{{ csrf_token() }}",
                "task_id": task_id
            }
        }
    } );

    $('#table_id tbody').on( 'click', 'button.icon-delete', function () {
                var getid = $(this).data('id');

                var myrow = table
                    .row( $(this).parents('tr') );

            swal("Are you sure?", "You will not be able to recover this Task!", {
              buttons: {
                cancel: "Cancel",
                catch: {
                  text: "Yes",
                  value: "delete",
                  className: "btn-danger",
                }
              },
            })
            .then((value) => {
              switch (value) {
             
                case "delete":
                  // myrow.remove().draw();

                     $.ajax({
                        url: "{{URL('/')}}/todo/"+getid,
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            "_method": "DELETE",
                        },
                        success: function(data){
                             fetchTodo(0)

                        }        
                   });
                  break;
             
                default:
                  swal.close();
              }
            });
            
        } );

    $('#table_id tbody').on( 'click', 'button.icon-completed', function () {
                var getid = $(this).data('id');

                var myrow = table
                    .row( $(this).parents('tr') );

            swal("Are you sure?", "You will not be able to recover this Task!", {
              buttons: {
                cancel: "Cancel",
                catch: {
                  text: "Yes",
                  value: "delete",
                  className: "btn-danger",
                }
              },
            })
            .then((value) => {
              switch (value) {
             
                case "delete":
                  // myrow.remove().draw();

                     $.ajax({
                        url: "{{URL('/')}}/todo/"+getid+"/completed",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(data){
                             fetchTodo(0)

                        }        
                   });
                  break;
             
                default:
                  swal.close();
              }
            });
            
        } );

}

</script>
@endsection