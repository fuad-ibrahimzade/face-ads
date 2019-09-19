<!DOCTYPE html>
<html>
@include('parts.head')
<body>
@include('parts.navbar')
<script>
    var placeholderText = {
        "Sahibkar": "info@sahibkar.az",
        "Agentlik": "info@agency.az",
        "Frilanser": "freelancer@mammadov.az"
    };

    // // $("#selectionType").on("change", function () {
    // //
    // //     // if (this.value != -1) {
    // //     $("#inputBox").val(placeholderText[$("#selectionType option:selected").text()]);
    // //     // } else {
    // //     //     $("#inputBox").val("");
    // //     // }
    // // alert('aaaa')
    // //
    // // });
    // function emailChanger() {
    //     $("#inputBox").val(placeholderText[$("#selectionType option:selected").text()]);
    // }
    // var placeholderText = {"First Name":"Enter your First Name","Last Name":"Enter your Last Name"};
    // $("#selectionType").on("change",function() {
    //     var selection = $("#selectionType");
    //     var inputBox = $("#inputBox");
    //
    //     var selectedVal = $(':selected', selection).text();
    //     if (placeholderText[selectedVal] !== undefined) {
    //         inputBox..attr('placeholder', placeholderText[selectedVal]);
    //     }
    // });
    // var currentInputValue = $("#selectionType").val();
    // $("#inputBox").attr("placeholder", "new placeholder value").val(currentInputValue);
    // document.getElementById('inputBox')[0].placeholder.value('new text for email');

    $(document).ready(function(){
        $("#inputBox").attr("placeholder", placeholderText['Sahibkar']);
        // $('input:email').attr('placeholder','Some New Text');
        // $("#inputBox").attr("placeholder", "new placeholder value").val(currentInputValue);
        // alert('asa')
        $("#selectionType").on("change",function() {
            var selection = $("#selectionType");
            var inputBox = $("#inputBox");

            var selectedVal = $(':selected', selection).text();
            // if (placeholderText[selectedVal] !== undefined) {
            //     inputBox..attr('placeholder', placeholderText[selectedVal]);
            // }
            $("#inputBox").attr("placeholder", placeholderText[selectedVal]);
        });
    })
    // var callback = function(){
    //     // Handler when the DOM is fully loaded
    //     // alert('bbb')
    // };
    //
    // if (
    //     document.readyState === "complete" ||
    //     (document.readyState !== "loading" && !document.documentElement.doScroll)
    // ) {
    //     callback();
    // } else {
    //     document.addEventListener("DOMContentLoaded", callback);
    // }
</script>
<div class="freelancer">
    <br>
    <br>
    <form action="{{url('password-reset')}}" method="post" novalidate >
        @csrf
        <fieldset style=" background-color:white;height: 45%;
width: 40%; margin-left: 33%;">
            <h3> Şifrəni Yenilə</h3> <br>
            @if (Session::has('error'))
                {{--<div class="alert alert-info">{{ Session::get('error') }}</div>--}}
                <div><strong>{{ Session::get('error') }}
                    </strong>
                </div>
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div><strong>{{$error}}</strong></div>
                @endforeach
            @endif
            @if (Session::has('warning'))
                {{--<div class="alert alert-info">{{ Session::get('error') }}</div>--}}
                <div><strong>{{ Session::get('warning') }}
                    </strong>
                </div>
            @endif
            @if (Session::has('success'))
                {{--<div class="alert alert-info">{{ Session::get('error') }}</div>--}}
                <div><strong>{{ Session::get('success') }}
                    </strong>
                </div>
            @endif
            <br>
            <span style="margin-left: 35px;">
            <br>
            <br>
            <span style="margin-left: 35px;">Email Ünvanı </span><br>
            {{--info@email.az--}}
            <input style="margin-left: 35px;" placeholder="aa" type="email" name="email" id="inputBox">
            <br><br>
            <br>
            <input style="margin-left: 55%" type="submit" name="Linki Göndər" value="Linki Göndər"> <br>

        </fieldset>
    </form>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</div>
@include('parts.footer')
</html>