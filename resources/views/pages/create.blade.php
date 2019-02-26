@extends('layouts.main')
@section('title', 'To Do')
@section('menu')
    {!! $menu !!}
@endsection

@section('content')

<div class="row gtr-uniform">
   <div class="col-12 col-12-xsmall">
        <form method="post" action="{{URL('/')}}/todo{{$todo_id != '' ? '/'.$todo_id : ''}}" method="POST">
            @csrf
        @if($todo_id != "")
        <input type="hidden" name="_method" value="PUT">
        @else
        @endif
        <div class="form-title">
            <h3 style="float:left; margin: 1em 1em .5em 1em;">{{$label}} Task</h3>
            <button href="{{URL('/')}}/todo" style="float:right; margin: 1em;" class="button primary small">
                <i class="fa fa-floppy-o"></i> Save
            </button>
            <a href="{{URL('/')}}/todo" style="float:right; margin: 1em;" class="button small">
                <i class="fa fa-arrow-left"></i> Back
            </a>
            <br>
            <br>
        </div>
            <div class="form-body" style="margin-top: 2em;">
                <div class="row gtr-uniform">
                    <div class="col-12 col-12-xsmall">
                        <label>Task Name</label>
                        <input type="text" name="task" value="{{$task}}" placeholder="Name" required>
                    </div>
                    <div class="col-12 col-12-xsmall">
                        <label>Remarks</label>
                        <textarea name="remarks" id="demo-message" placeholder="Enter your message" rows="6">{{$remarks}}</textarea>
                    </div>

                    <div class="col-6 col-12-xsmall">
                        <label>Start Date</label>
                        <input type="text" class="datepicker" name="sDate" value="{{$sDate}}" placeholder="MM-DD-YYYY">
                    </div>
                    <div class="col-6 col-12-xsmall">
                        <label>End Date</label>
                        <input type="text" class="datepicker" name="eDate" value="{{$eDate}}" placeholder="MM-DD-YYYY">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('page-script')
<script>
  $( function() {
    $( ".datepicker").datepicker({
        dateFormat: 'mm-dd-yy'
    });
  } );
</script>
@endsection