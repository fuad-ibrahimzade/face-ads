<noscript><meta http-equiv="refresh" content="0; URL={{url('badbrowser')}}"></noscript>
<script src="{{asset('js/app.js')}}"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<link type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" rel="stylesheet" />

@if(Str::contains(url()->current(),'/add-smm-work'))
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endif

{{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">--}}
{{--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>--}}
{{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>--}}
{{--<link type="text/css" href="{{asset('css/app.css')}}" rel="stylesheet" />--}}

<script type="text/javascript">
    $(document).ready(function() {
        $('html, body').animate({scrollTop: '0px'},200);
        evvelkiPImage=$('.thumb_profile_image').attr('src');
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.thumb_profile_image').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
            else {
                $('.thumb_profile_image').attr('src', evvelkiPImage);
            }
        }

        $(".profile_image").change(function () {
            readURL(this);
        });

        $("form").submit(function(e){
            if (!$('.terms').is(':checked') && $('.registration_class').length !=0) {
                if($('.registration_class').length == 0) {
                    return;
                }
                e.preventDefault();
                $('.main_errors').hide();
                $('.other_errors > strong').text('şərtləri qəbul Edin');
                $('html, body').animate({scrollTop: '0px'},200);
            }
            $('.qutu_parent').find('select').each(function () {
                $(this).prop("disabled", false);
            });
            $('.qutu_parent').find('select').find('option').each(function () {
                // $(this).attr('selected','selected')
                $(this).prop("selected", true);
            })
            errorMessages=''
        });
        function validateEmail($email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test( $email );
        }

        $(".sector_adder").click(function () {
            new_sectorTexti=$(".new_sector_temp").val();
            new_sectorTexti=new_sectorTexti.charAt(0).toUpperCase() + new_sectorTexti.substr(1).toLowerCase();
            if(!isNaN(new_sectorTexti) || !isNaN(parseInt(new_sectorTexti))){
                $('.main_errors').hide();
                $('.other_errors > strong').text('düzgün sektor yazın');
                $('html, body').animate({scrollTop: '0px'},200);
                return;
            }

            $(".sector_parent").append('<div class="isector_parent"><input type="checkbox" name="sector[]" class="sector" value="'+new_sectorTexti+'" checked>&nbsp' + new_sectorTexti +'</div>')
            $(".new_sector_temp").val('');
        });
        $('.new_sector_remover').click(function() {
            $('.isector_parent').each(function () {
                if($(this).find('input').prop("checked") == true)$(this).remove();
            });
        });
        $(".new_price_adder").click(function () {
            if($('.qutu_parent').find('select').length==0){
                $(".new_price_box_adder").trigger('click');
            }
            new_priceMin=parseInt($('#price-slider-range').slider("values")[0]);
            new_priceMax=parseInt($('#price-slider-range').slider("values")[1]);
            new_priceMin=parseInt($("#price-slider-range").slider("value"));
            new_priceMax=new_priceMin;
            if(isNaN(new_priceMax) || isNaN(new_priceMin)){
                $('.main_errors').hide();
                $('.other_errors > strong').text('düzgün rəqəm yazın');
                $('html, body').animate({scrollTop: '0px'},200);
                return;
            }
            if(new_priceMax==0){
                $('.main_errors').hide();
                $('.other_errors > strong').text('qiymət sıfır olmamalıdır');
                $('html, body').animate({scrollTop: '0px'},200);
                return;
            }
            $('.first_price').remove();
            var filter = new_priceMin;
            var clone_found=false;
            var newSuffixCount1MIN=$('.qutu_parent').find('select').length.toString();
            if(newSuffixCount1MIN=='1')newSuffixCount1MIN='';
            for (let i = 0; i  < $('.qutu_parent').find('select').length; i++) {
                if(i==0){newSuffixCount1MIN='';}
                else{newSuffixCount1MIN=i+1}
                $('.pricing'+newSuffixCount1MIN+' option').each(function() {
                    if (parseInt($(this).val()) == filter) {
                        clone_found=true;
                    }
                })
            }
            if(clone_found){
                $('.main_errors').hide();
                $('.other_errors > strong').text('qiymət artıq var');
                $('html, body').animate({scrollTop: '0px'},200);
                return;
            }
            if($('.qutu_parent').find('select').length<3 && $(".pricing"+newSuffixCount1MIN).children().length==1 && $(".pricing"+newSuffixCount1MIN).find('option').value!='0 AZN'){
                $('.new_price_box_adder').trigger('click');
                $(".new_price_adder").trigger('click');
                return;
            }
            else if($('.qutu_parent').find('select').length>2 && $(".pricing"+newSuffixCount1MIN).children().length==1 && $(".pricing"+newSuffixCount1MIN).find('option').value!='0 AZN'){
                $('.main_errors').hide();
                $('.other_errors > strong').text('maksimum 3 paket yarada bilərsiniz.');
                $('html, body').animate({scrollTop: '0px'},200);
                return;
            }
            new_priceTexti=new_priceMin;
            $(".pricing"+newSuffixCount1MIN).append('<option selected>'+new_priceTexti+' AZN</option>');
            var selectList = $('.pricing'+newSuffixCount1MIN+' option');
            selectList.sort(function(a,b){
                a = parseInt(a.value);
                b = parseInt(b.value);

                return a-b;
            });
            $('.pricing'+newSuffixCount1MIN).html(selectList);
        });
        $('.new_price_remover').click(function() {
            var newSuffixCount1MIN=$('.qutu_parent').find('select').length.toString();
            if(newSuffixCount1MIN=='1')newSuffixCount1MIN='';

            $('.pricing'+newSuffixCount1MIN).find('option:selected').remove();
            if($('.pricing'+newSuffixCount1MIN).children().length==0){
                $('.pricing'+newSuffixCount1MIN).remove();
                $('.pricing_group'+newSuffixCount1MIN).remove();
                $('.pricing'+(newSuffixCount1MIN==1 ? '':newSuffixCount1MIN-1)).prop('disabled',false);
            }
            newSuffixCount1MIN=$('.qutu_parent').find('select').length.toString();
            if(newSuffixCount1MIN=='1')newSuffixCount1MIN='';
            $('.pricing'+newSuffixCount1MIN).prop('disabled',false);
            $('.pricing'+newSuffixCount1MIN).find('option').each(function () {
               $(this).prop('selected',true);
            });
        });
        $('.new_price_box_adder').click(function() {
            if($('.qutu_parent').find('select').length>2){
                $('.main_errors').hide();
                $('.other_errors > strong').text('maksimum 3 paket yarada bilərsiniz.');
                $('html, body').animate({scrollTop: '0px'},200);
                azn0only=true;
                return;
            }
            var azn0only=false;
            $('.qutu_parent').find('select').each(function () {
                if($(this).find('option').length==1 && $(this).find('option').eq(0).val()=='0 AZN'){
                    $('.main_errors').hide();
                    $('.other_errors > strong').text('ən azı bir qiymət daxil edin');
                    $('html, body').animate({scrollTop: '0px'},200);
                    azn0only=true;
                    return;
                }
                $(this).attr('disabled','disabled');
            })
            if(azn0only)return;
            var newSuffixCount=$('.qutu_parent').find('select').length+1;
            newSuffixCount=newSuffixCount.toString();
            if(newSuffixCount=='1')newSuffixCount='';
            $('.qutu_parent').append('' +
                '        <div class="flex-column pricing_group'+newSuffixCount+'">\n' +
                '            <em style="font-style: italic; display: inline-block;">'+( newSuffixCount!='' ? newSuffixCount : newSuffixCount+1)+'- </em>&nbsp;&nbsp;\n' +
                '        </div>')
            $('.qutu_parent').append('    <select multiple=\'multiple\' name="pricing'+newSuffixCount+'[]" class="flex-column pricing'+newSuffixCount+'" id="pricing'+newSuffixCount+'">\n' +
                '      <option class="first_price" selected>0 AZN</option>\n' +
                '    {{--<option class="first_price">0-250 AZN</option>--}}\n' +
                '    {{--<option>251-400 AZN</option>--}}\n' +
                '    {{--<option>401-600 AZN</option>--}}\n' +
                '    {{--<option>601-daha çox </option>--}}\n' +
                '    </select>');
        });
        $(function() {
            $( "#price-slider-range" ).slider({
                range: false,
                step: 50,
                min: 0,
                max: 3000,
                value:  75,
                slide: function( event, ui ) {
                    $( "#price-amount" ).val( ui.value+ " AZN" );
                },
            });
            $( "#price-amount" ).val( $( "#price-slider-range" ).slider( "value" ) + " AZN  " );
        });
        $(".new_city_adder").click(function () {
            new_cityTemp=($(".new_city_temp").val());
            new_cityTemp=new_cityTemp.charAt(0).toUpperCase() + new_cityTemp.substr(1).toLowerCase()
            // new_cityTemp=($(".new_city_temp").find('option:selected').text());

            if(!isNaN(new_cityTemp) || !isNaN(parseInt(new_cityTemp))){
                $('.main_errors').hide();
                $('.other_errors > strong').text('düzgün yer yazın');
                $('html, body').animate({scrollTop: '0px'},200);
                return;
            }
            $(".city").append('<option selected>'+new_cityTemp+'</option>');
            $(".new_city_adder").css('display','none');
            $(".new_city_temp").css('display','none');
        });
        $('select[name=price_min]').change(function(e){
            if(parseInt($('select[name=price_max]').val())<=parseInt($('select[name=price_min]').val())){
                $('select[name=price_max]').val(parseInt($('select[name=price_min]').val())+100)
                if(!$('select[name=price_max]').val()){
                    $('select[name=price_max]').val(2000)
                }
            }
        })
        $('select[name=price_max]').change(function(e){
            if(parseInt($('select[name=price_max]').val())<=parseInt($('select[name=price_min]').val())){
                $('select[name=price_min]').val($('select[name=price_max]').val()-100)
            }
            if(!$('select[name=price_min]').val()){
                $('select[name=price_min]').val(100)
            }
        })
        $('select[name=price_min2]').change(function(e){
            if(parseInt($('select[name=price_max2]').val())<=parseInt($('select[name=price_min2]').val())){
                $('select[name=price_max2]').val(parseInt($('select[name=price_min2]').val())+100)
                if(!$('select[name=price_max2]').val()){
                    $('select[name=price_max2]').val(2000)
                }
            }
        })
        $('select[name=price_max2]').change(function(e){
            if(parseInt($('select[name=price_max2]').val())<=parseInt($('select[name=price_min2]').val())){
                $('select[name=price_min2]').val($('select[name=price_max2]').val()-100)
            }
            if(!$('select[name=price_min2]').val()){
                $('select[name=price_min2]').val(100)
            }
        })
        $('.fa-comment-o').hover(function(e){
            $('.fa-comment-o').tooltip()
        })
        @auth
            if('{{auth()->user()->customer_type!="Entrepreneur"}}'){
                if(document.URL.indexOf('/profile/')!=-1){
                    get_SMMWorksForServiceProvidersAJAX();
                }
            }
            // $('span[name=work_end]').datepicker();
            $('#datepicker').datepicker({
                uiLibrary: 'bootstrap4'
            });
            $('input[name=work_start]').datepicker({
                uiLibrary: 'bootstrap4'
            });
            $('input[name=work_end]').datepicker({
                uiLibrary: 'bootstrap4'
            });
        @endauth
        $('.isocial_parent > input').blur(function(e){
            if($(this).val()){
                $(this).parent().find('img').css('filter','grayscale(0%)')
            }
            else{
                $(this).parent().find('img').css('filter','grayscale(100%)')
            }
        })
        @if(Str::contains(url()->current(),'/profile/') && url()->current()==='http://localhost/profile/'.auth()->user()->email || Str::contains(url()->current(),'/profile/'))
            if($('.smmworks').children().length<8 || $('.smm_customer').length>0){
                $('footer').css('margin-top','100vh')
            }
            setInterval(function(){
                // alert("Hello");
                if($('.smmworks').length>0 && $('.smmworks').children().length<8 || $('.smm_customer').length>0){
                    $('footer').css('margin-top','100vh')
                    if($('.smm_customer').length>0){
                        $('footer').css('margin-top',$('.smm_customers').css('height')+'px')
                    }
                }
                else{
                    $('footer').css('margin-top','150px')
                }
                }, 100);
            $('input[name=submit2]').click(function () {
                // event.stopImmediatePropagation();
                // event.preventDefault();
                if($('input[name=email]').val()!='{{auth()->user()->email}}'){
                    $('#emailChangeModal').modal('show')
                }
                else{
                    $('input[name=submit]').trigger('click');
                }
            })
            $('#emailChangeModal').find('.modal-footer').find('.btn-primary').click(function () {
                $('#emailChangeModal').modal('hide')
                $('input[name=submit]').trigger('click');
                // $('.freelancer').find('form').submit()
            })
        @endif
    });

    function smmservice_provider_user_link_handler(element,secondOrMain){
        sufixtoAdd=''
        if(secondOrMain==2){sufixtoAdd=2;}
        else{sufixtoAdd='';}

        $('.comparision-container'+sufixtoAdd).css('display','none');

        // $('.smmprovider-info-container').find('')


        $('.smmprovider-loading'+sufixtoAdd).css('display','initial');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: ""+$(element).attr('href'),
            method: 'get',
            data: {
                "_token": "{{ csrf_token() }}",
                email: $(element).attr('href').replace(/[a-zA-Z\//:.]*user\//g,'')
            },
            success: function(result){

            },
            complete: function (jqXHR,status) {
                if(status == 'success' || status=='notmodified')
                {
                    // var asset = new asset(item.Type, item.Url, $.parseJSON(jqXHR.responseText))
                    // alert(jqXHR.responseText);
                    resultJson=$.parseJSON(jqXHR.responseText)
                    {{--$('.smmprovider-info-container'+sufixtoAdd).find('img').eq(0).attr('src',"{{asset('storage/avatars/')}}"+'/'+resultJson.smmservice_provider_user[0].profile_image)--}}
                    $('.smmprovider-info-container'+sufixtoAdd).find('img').eq(0).attr('src',resultJson.smmservice_provider_user[0].profile_image)
                    $('.smmprovider-info-container'+sufixtoAdd).find('span').eq(0).find('span').eq(0).html(resultJson.smmservice_provider_user[0].activity);
                    // alert(resultJson.smmservices_unique[0].business_mark_name)
                    smmservices_uniqueToAdd='';
                    for (let i = 0; i < resultJson.smmservices_unique.length; i++) {
                        smmservices_uniqueToAdd+='<div class="smm_customer" style=" white-space: nowrap; width: auto"> '+
                            resultJson.smmservices_unique[i].business_mark_name+'<a onclick="smm_customer_link_handler(this,'+secondOrMain+'); return false;" href="'+
                            '{{url(" ")}}'.trim()+resultJson.smmservice_provider_user[0].email+'/analyse/'+resultJson.smmservices_unique[i].business_mark_id+
                            '" style="text-decoration-line:none;" > '+
                            '  Performans Dəyərləndirməsinə Bax </a></div>'
                    }
                    $('.smm_customers'+sufixtoAdd).append(smmservices_uniqueToAdd);

                    $('.smmprovider-loading'+sufixtoAdd).css('display','none');
                    $('html, body').animate({scrollTop: '0px'},200);
                    $('.smmprovider-info-container'+sufixtoAdd).css('display','inherit');
                    $('.smm_customers'+sufixtoAdd).css('display','inherit')
                }
            }
        });

        return false;
    }
    function smm_customer_link_handler(element,secondOrMain){
        sufixtoAdd=''
        if(secondOrMain==2){sufixtoAdd=2;}
        else{sufixtoAdd='';}

        $('.smmprovider-info-container'+sufixtoAdd).css('display','none');
        $('.smm_customers'+sufixtoAdd).css('display','none')
        $('.smmprovider-work-compare-container').css('display','none');

        if(sufixtoAdd==2)$('.smmprovider-work-container > .compare_link').css('display','none');

        // $('.smmprovider-info-container').find('')


        $('.smmprovider-loading'+sufixtoAdd).css('display','initial');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: ""+$(element).attr('href'),
            method: 'get',
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success: function(result){

            },
            complete: function (jqXHR,status) {
                if(status == 'success' || status=='notmodified')
                {
                    resultJson=$.parseJSON(jqXHR.responseText)
                    $('.smmprovider-work-container'+sufixtoAdd).find('p').html('"'+resultJson.smmmservice_work[0].business_mark_name+'" Sosial Media Marketing Performans Dəyərləndirməsi')

                    $('.smmprovider-loading'+sufixtoAdd).css('display','none');
                    $('html, body').animate({scrollTop: '0px'},200);
                    $('.smmprovider-work-container'+sufixtoAdd).css('display','inherit');

                    if(sufixtoAdd==2){
                        $('#myModal1').modal('hide');

                        $('.smmprovider-work-compare-container').find('p').html('"'+resultJson.smmmservice_work[0].business_mark_name+'" Sosial Media Marketing Performans Dəyərləndirməsi')
                        $('.smmprovider-work-compare-container').css('display','inherit');
                    }
                }
            }
        });
    }
    function compare_link_handler(element,whatToDo=null){

        sufixtoAdd=2;
        $('.comparision-container'+sufixtoAdd).children().eq(1).children().html('')
        $('.comparision-container'+sufixtoAdd).children().eq(3).children().html('')
        $('.comparision-container'+sufixtoAdd).children().eq(0).css('display','none');
        $('.comparision-container'+sufixtoAdd).children().eq(2).css('display','none');
        if(whatToDo && whatToDo=='close'){
            $('.smmprovider-info-container'+sufixtoAdd).css('display','none');
            $('.smm_customers'+sufixtoAdd).css('display','inherit')
            $('.smmprovider-work-compare-container').css('display','none');

            $('.smmprovider-work-container > .compare_link').css('display','initial');

            // $('.smmprovider-work-container').css('display','none');
            return;
        }
        $('#myModal1').modal('show')
    }
    function get_ServiceProvidersForEntrepreneurAJAX(element,secondOrMain) {
        @auth
        sufixtoAdd=''
        if(secondOrMain==2){sufixtoAdd=2;}
        else{sufixtoAdd='';}
        $('.smmprovider-info-container'+sufixtoAdd).css('display','none');
        $('.smmprovider-work-container'+sufixtoAdd).css('display','none');
        $('.smmprovider-work-compare-container'+sufixtoAdd).css('display','none');


        $('.comparision-container'+sufixtoAdd).children().eq(1).children().html('')
        $('.comparision-container'+sufixtoAdd).children().eq(3).children().html('')
        $('.comparision-container'+sufixtoAdd).children().eq(0).css('display','none');
        $('.comparision-container'+sufixtoAdd).children().eq(2).css('display','none');

        $('.comparision-container'+sufixtoAdd).css('display','none');
        $('.smmprovider-loading'+sufixtoAdd).css('display','initial');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{url('searchfilter_at_entrepreneur')}}',
            method: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                'sector':$('select[name=sector'+sufixtoAdd+']').val(),
                'price_min':$('select[name=price_min'+sufixtoAdd+']').val(),
                'price_max':$('select[name=price_max'+sufixtoAdd+']').val(),
                'city':$('select[name=city'+sufixtoAdd+']').val(),
            },
            success: function(result){

            },
            complete: function (jqXHR,status) {
                if(status == 'success' || status=='notmodified')
                {
                    $('.smmprovider-loading'+sufixtoAdd).css('display','none');
                    // var asset = new asset(item.Type, item.Url, $.parseJSON(jqXHR.responseText))
                    // alert(jqXHR.responseText);
                    resultJson=$.parseJSON(jqXHR.responseText);
                    // $('.modal-body').find('.price_min').val()
                    divtoaddAgency=''
                    divtoaddFreelancer=''
                    divtoadd=' '
                    $.each(resultJson.smmservice_provider_users, function (i, item) {
                        // alert(item.profile_image);
                        divtoadd='<div class="smmservice_provider_user'+sufixtoAdd+'">'+
                            '<img  style="margin-left: 9px" width="6%" src="'+item.profile_image+'"><br>'+
                            '<a onclick="smmservice_provider_user_link_handler(this,'+secondOrMain+'); return false;" style="text-decoration-line: none;" href="{{url('user/')}}'+'/'+item.email+'"><span style= "margin-left: 9px;"> '+item.name+'  </span> </a>'+
                            '</div>';
                        if(item.customer_type=='Agency'){
                            $('.comparision-container'+sufixtoAdd).children().eq(1).append(divtoadd)
                        }
                        else if(item.customer_type=='Freelancer'){
                            $('.comparision-container'+sufixtoAdd).children().eq(3).append(divtoadd)
                        }
                        // $('.comparision-container'+sufixtoAdd).append(divtoadd)
                    });
                    $('.comparision-container'+sufixtoAdd).children().eq(0).css('display','initial');
                    $('.comparision-container'+sufixtoAdd).children().eq(2).css('display','initial');

                    $('.smmprovider-loading'+sufixtoAdd).css('display','none');
                    $('.comparision-container'+sufixtoAdd).css('display','inherit');
                }
            }
        });
        @endauth
    }

    function get_SMMWorksForServiceProvidersAJAX(firstcallornot=false) {
        @auth
        // $('.edit_profile').attr('src').replace('http://localhost/profile/','').replace('/edit','')
        $('.container').eq(0).find('tbody').eq(0).html('')
        $('.container').css('display','none');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{url('works_of_serviceprovider')}}',
            method: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                'email_of_provider':'{{auth()->user()->email}}',
            },
            success: function(result){

            },
            complete: function (jqXHR,status) {
                if(status == 'success' || status=='notmodified')
                {
                    resultJson=$.parseJSON(jqXHR.responseText);
                    // $('.modal-body').find('.price_min').val()
                    divtoaddAgency=''
                    divtoaddFreelancer=''
                    divtoadd=' '
                    $.each(resultJson.smm_works, function (i, item) {
                        divtoadd='<tr><th scope="row">'+(i+1)+'</th><td>'+item.business_mark.name+
                                '</td><td><img style=" margin-left: 5%; height: 45px;" src="'+item.business_mark.profile_image+'"></td>'+
                                // '<td>'+item.pricing+'</td>'+
                                '<td>'+item.work_start+'</td>' +
                                '<td>'+(item.work_end==null?'təyin olunmayıb':item.work_end)+'</td>'+
                                '<td><a class="btn btn-default fa fa-comment-o fa-lg" style="background-color: transparent" data-toggle="tooltip" data-placement="top" title="message"></a></td>' +
                                '<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a style="" href="{{url(auth()->user()->email)}}/smmservice/update/'+item.id+'"><img src="{{asset('/images/pencil-edit-button.png')}}" height="20"/></a>'+
                            '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="#'+item.id+'" onclick="deleteSMMWorkPrompt(this)"><img src="{{asset('/images/delete-button.png')}}" height="20"/></a>'+
                            '<div style="display:none; ">\n' +
                            '<form action="{{url(Auth::user()->email.'/smmservice/delete')}}/'+item.id+'" id="smmservice-delete'+item.id+'" method="post" style="display: block; margin: 0">\n' +
                            '@csrf\n' +

                            '</form>\n' +
                            '</div>'+'</td>' +
                            '</tr>';
                        $('.container').eq(0).find('tbody').eq(0).append(divtoadd);
                    });
                    if(resultJson.smm_works.length>0) {
                        $('.container').css('display', 'inherit');
                    }
                }
            }
        });
        @endauth
    }

    function deleteSMMWorkPrompt(element) {
        $('.smmservice_to_delete').text($(element).attr('href').replace('#',''));
        $('#deleteModal').modal('show');
    }
    function confirmDeleteSMMWorkPrompt() {
        $('#deleteModal').modal('hide');
        document.getElementById('smmservice-delete'+$('.smmservice_to_delete').text()).submit();
    }
</script>