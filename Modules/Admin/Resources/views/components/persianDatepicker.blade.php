<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>
<script src="{{asset('css/admin/plugins/persian-datepicker/jquery.md.bootstrap.datetimepicker.js')}}" type="text/javascript"></script>
    <div class="input-group">

        <input type="text" id="{{"input$name"}}" class="form-control" placeholder="{{$placeholder}}" aria-label="{{$name}}"
               aria-describedby="{{$name}}">
        <input type="text" style="display: none" id="{{"input1$name"}}" class="form-control" placeholder="" name="{{$name}}" aria-label="{{$name}}"
               aria-describedby="{{$name}}">
        <div class="input-group-prepend">
            <span class="input-group-text cursor-pointer" id="{{$name}}"><i class="fa fa-calendar"></i></span>
        </div>
    </div>
<script type="text/javascript">
    $('#{{$name}}').MdPersianDateTimePicker({
        targetTextSelector: '{{"#input$name"}}',
        enableTimePicker: true,
        targetDateSelector: '{{"#input1$name"}}',
        modalMode: true,
        dateFormat: 'yyyy-MM-dd HH:mm',
        textFormat: 'yyyy-MM-dd HH:mm',
    });
</script>