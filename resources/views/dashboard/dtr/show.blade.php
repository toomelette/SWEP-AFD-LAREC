@extends('layouts.modal-content',['decolor'=> 1])

@section('modal-header')
{{$employee->lastname}}, {{$employee->firstname}} {{strtoupper($employee->name_ext)}} | {{$employee->employee_no}}
@endsection

@section('modal-body')
    {!! $section !!}
@endsection

@section('modal-footer')
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(".month_btn").click(function () {
            btn = $(this);
            var month = $(this).attr('month');
            var bm_u_id = "{{$employee->biometric_user_id}}";
            load_modal2(btn);
            $.ajax({
                url : '{{route("dashboard.dtr.fetch_by_user_and_month")}}',
                data : {bm_u_id : bm_u_id, month: month},
                type: 'GET',
                success: function (res) {
                    populate_modal2(btn,res);
                },
                error: function (res) {
                    populate_modal2_error(res);
                }
            })
        })
    </script>
@endsection

