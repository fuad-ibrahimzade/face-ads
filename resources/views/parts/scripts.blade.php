<script src="{{asset('js/app.js')}}"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" rel="stylesheet" />

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
            // var imgWidth = $('#target').width();
            // var imgHeight = $('#target').height();
            // if(imgWidth > 400 || imgHeight > 200){
            //     alert('Your image is too big, it must be less than 200x400');
        });

        $("form").submit(function(e){
            // e.preventDefault();
            if (!$('.terms').is(':checked') && $('.registration_class').length !=0) {
                if($('.registration_class').length == 0) {
                    return;
                }
                e.preventDefault();
                // $('.main_errors').each(function() });
                $('.main_errors').hide();
                $('.other_errors > strong').text('şərtləri qəbul Edin');
                $('html, body').animate({scrollTop: '0px'},200);
            }
            // $('select.pricing option').attr("selected","selected");
            // $('select.pricing2 option').attr("selected","selected");
            // $('select.pricing2 option').attr("selected","selected");
            $('.qutu_parent').find('select').each(function () {
                // $(this).attr('disabled','');
                $(this).prop("disabled", false);
            });
            $('.qutu_parent').find('select').find('option').each(function () {
                // $(this).attr('selected','selected')
                $(this).prop("selected", true);
            })
            errorMessages=''
            // ------------------------------------
            // if(!validateEmail($('.email').val())){
            //     errorMessages+='email daxil edilməlidir <br>'
            // }
            // if(!$('.name').text().match('^[a-zA-Z]{3,16}$')){
            //     errorMessages+='ad daxil edilməlidir <br>'
            // }
            // if(!$('.activity').val().trim().lenght==0){
            //     errorMessages+='öz haqqınızda məlumat daxil edin <br>'
            // }
            // // if(!$('.activity').val().trim().lenght==0){
            // //     errrorMessages+='öz haqqınızda məlumat daxil edin <br>'
            // // }
            // // if(!$('.activity').val().trim().lenght==0){
            // //     errrorMessages+='öz haqqınızda məlumat daxil edin <br>'
            // // }
            // // alert($('.email').val()) +' '+ errorMessages.length);
            // if(errorMessages.length>1){
            //     e.preventDefault();
            //     $('.main_errors').hide();
            //     $('.other_errors > strong').html(errorMessages);
            //     $('html, body').animate({scrollTop: '0px'},200);
            //     // return;
            // }
            // ------------------------------------
            // else {
            //     e.preventDefault();
            //     alert('please check terms & conditions')
            // }
        });
        function validateEmail($email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            // emailReg=/^[a-zA-Z]([a-zA-Z0-9_\.\-\+])+\@([a-zA-Z]([a-zA-Z0-9\-])+\.)+[a-zA-Z]([a-zA-Z0-9]{2,4})+$/;
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

            // $(".new_sector").val(new_sectorTexti);
            // // alert($(".new_sector_temp").val())
            // $(".new_sector").attr('checked',true);
            // $(".new_sector_text").text(new_sectorTexti);
            // $(".new_sector").css('display','inline');
            // $(".new_sector_text").css('display','inline');
            // $(".new_sector_text").after('<br>');

            // $(".new_sector_temp").css('display','none');
            // $(".sector_adder").css('display','none');

            $(".sector_parent").append('<div class="isector_parent"><input type="checkbox" name="sector[]" class="sector" value="'+new_sectorTexti+'" checked>&nbsp' + new_sectorTexti +'</div>')
            $(".new_sector_temp").val('');
        });
        $('.new_sector_remover').click(function() {
            // $('.sector').find('option:checked').remove();
            $('.isector_parent').each(function () {
                if($(this).find('input').prop("checked") == true)$(this).remove();
                // $('.sector').find('option:checked').remove();
                // if($('.registration_class').length ==0) {
                //     //yeni profil editdise
                //     $(this).remove();
                // }
                // else {
                //     $(this).find('option:checked').remove();
                //     // $(this).find('.isector_parent > .sector').each(function () {
                //     //     if($(this).attr('checked')){
                //     //         $(this).parentElement.remove()
                //     //     }
                //     // })
                // }
            });
        });
        $(".new_price_adder").click(function () {
            // new_priceMin=parseInt($(".new_price_min").val());
            // new_priceMax=parseInt($(".new_price_max").val());
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
            // $('.pricing').find('option').each(function(){
            //     if(parseInt($(this).val()) == filter){
            //         $(this).remove();
            //     }
            // })
            var newSuffixCount1MIN=$('.qutu_parent').children().length.toString();
            if(newSuffixCount1MIN=='1')newSuffixCount1MIN='';
            $('.pricing'+newSuffixCount1MIN+' option').each(function() {
                if (parseInt($(this).val()) == filter) {
                    // alert('asasas')
                    clone_found=true;
                }
            })
            if(clone_found)return;
            // if(new_priceMin>new_priceMax || new_priceMin<0 || new_priceMax<0 || new_priceMax==new_priceMin){
            //     $('.main_errors').hide();
            //     $('.other_errors > strong').text('düzgün rəqəm yazın');
            //     $('html, body').animate({scrollTop: '0px'},200);
            //     return;
            // } RANGEDE LAZIMDI
            // new_priceTexti=new_priceMin + '-' + new_priceMax
            new_priceTexti=new_priceMin;
            $(".pricing"+newSuffixCount1MIN).append('<option selected>'+new_priceTexti+' AZN</option>');
            // $(".new_price_adder").css('display','none');
            // $(".new_price_max").css('display','none');
            // $(".new_price_min").css('display','none');
            var selectList = $('.pricing'+newSuffixCount1MIN+' option');
            selectList.sort(function(a,b){
                a = parseInt(a.value);
                b = parseInt(b.value);

                return a-b;
            });
            $('.pricing'+newSuffixCount1MIN).html(selectList);
        });
        $('.new_price_remover').click(function() {
            var newSuffixCount1MIN=$('.qutu_parent').children().length.toString();
            if(newSuffixCount1MIN=='1')newSuffixCount1MIN='';

            $('.pricing'+newSuffixCount1MIN).find('option:selected').remove();
            if($('.pricing'+newSuffixCount1MIN).children().length==0){
                $('.pricing'+newSuffixCount1MIN).remove();
                $('.pricing'+(newSuffixCount1MIN==1 ? '':newSuffixCount1MIN-1)).prop('disabled',false);
            }
            newSuffixCount1MIN=$('.qutu_parent').children().length.toString();
            if(newSuffixCount1MIN=='1')newSuffixCount1MIN='';
            $('.pricing'+newSuffixCount1MIN).prop('disabled',false);
            $('.pricing'+newSuffixCount1MIN).find('option').each(function () {
               $(this).prop('selected',true);
            });
        });
        // $(function() {
        //     $( "#price-slider-range" ).slider({
        //         range: true,
        //         step: 50,
        //         min: 0,
        //         max: 2000,
        //         values: [ 75, 300],
        //         slide: function( event, ui ) {
        //             $( "#price-amount" ).val( ui.values[ 0 ] + " AZN - " + ui.values[ 1 ] + " AZN");
        //         },
        //     });
        //     $( "#price-amount" ).val( $( "#price-slider-range" ).slider( "values", 0 ) +
        //         " AZN - " + $( "#price-slider-range" ).slider( "values", 1 ) + " AZN");
        // });
        $('.new_price_box_adder').click(function() {
            if($('.qutu_parent').find('select').length>2){
                $('.main_errors').hide();
                $('.other_errors > strong').text('maksimum 3 paket qutusu yarada bilərsiniz.');
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
            $('.qutu_parent').append('    <select multiple=\'multiple\' name="pricing'+newSuffixCount+'[]" class="pricing'+newSuffixCount+'" id="pricing'+newSuffixCount+'">\n' +
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
                max: 2000,
                value:  75,
                slide: function( event, ui ) {
                    $( "#price-amount" ).val( ui.value+ " AZN" );
                },
            });
            $( "#price-amount" ).val( $( "#price-slider-range" ).slider( "value" ) + " AZN  " );
        });
        // $(function() {
        //     $( "#price-slider-range-entrepreneur" ).slider({
        //         range: true,
        //         step: 50,
        //         min: 0,
        //         max: 2000,
        //         values:  [75,200],
        //         slide: function( event, ui ) {
        //             $( "#price-amount" ).val( ui.values[0]+ " AZN" );
        //         },
        //     });
        //     $( "#price-amount" ).val( $( "#price-slider-range-entrepreneur" ).slider( "values",0 ) + " AZN  " );
        // });
        // $.getJSON(url, function (data) {
        //     $.each(data, function (key, entry) {
        //         dropdown.append($('<option></option>').attr('value', entry.abbreviation).text(entry.name));
        //     })
        // });
        // $('.city')
        $(".new_city_adder").click(function () {
            new_cityTemp=($(".new_city_temp").val());
            new_cityTemp=new_cityTemp.charAt(0).toUpperCase() + new_cityTemp.substr(1).toLowerCase()
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
        // $('.register_link_parent').hover(function(e){
        //     var indexim=$('tr:nth-child(1) > td').index($(this))
        //     if(indexim==-1)indexim=$('tr:nth-child(2) > td').index($(this))
        //     // body > div > div > table > tbody > tr:nth-child(2) > td:nth-child(3)
        //     $('.register_link_parent').each(function (e) {
        //         var indexim2=$('tr:nth-child(1) > td').index($(this))
        //         if(indexim2==-1)indexim2=$('tr:nth-child(2) > td').index($(this))
        //         if(indexim==indexim2)$(this).css({'transform':'scale(1.2)','transition':'0.5s'});
        //         // $(this).css('transition','0.5s');
        //     })
        // })
        {{--$(".pricing").change(function(e){--}}
            {{--e.preventDefault();--}}
            {{--$.ajaxSetup({--}}
                {{--headers: {--}}
                    {{--'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')--}}
                {{--}--}}
            {{--});--}}
            {{--jQuery.ajax({--}}
                {{--url: "{{ url('/services') }}",--}}
                {{--method: 'get',--}}
                {{--data: {--}}
                    {{--"_token": "{{ csrf_token() }}",--}}
                    {{--selected_packet_price: jQuery('.pricing').val()--}}
                {{--},--}}
                {{--success: function(result){--}}
                    {{--jQuery('.services_for_price').html(result.services_for_price);--}}

                {{--}});--}}

        {{--});--}}

        {{--$(".smmservice_provider_user > a").click(function(e){--}}
            {{--e.preventDefault();--}}
            {{--$('.comparision-container').css('display','none');--}}

            {{--// $('.smmprovider-info-container').find('')--}}


            {{--$('.smmprovider-loading').css('display','initial');--}}
            {{--$.ajaxSetup({--}}
                {{--headers: {--}}
                    {{--'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')--}}
                {{--}--}}
            {{--});--}}
            {{--$.ajax({--}}
                {{--url: ""+$(this).attr('href'),--}}
                {{--method: 'get',--}}
                {{--data: {--}}
                    {{--"_token": "{{ csrf_token() }}",--}}
                    {{--email: $(this).attr('href').replace(/[a-zA-Z\//:.]*user\//g,'')--}}
                {{--},--}}
                {{--success: function(result){--}}

                {{--},--}}
                {{--complete: function (jqXHR,status) {--}}
                    {{--if(status == 'success' || status=='notmodified')--}}
                    {{--{--}}
                        {{--// var asset = new asset(item.Type, item.Url, $.parseJSON(jqXHR.responseText))--}}
                        {{--// alert(jqXHR.responseText);--}}
                        {{--resultJson=$.parseJSON(jqXHR.responseText)--}}
                        {{--$('.smmprovider-info-container').find('img').attr('src',"{{asset('storage/avatars/')}}"+'/'+resultJson.smmservice_provider_user[0].profile_image)--}}
                        {{--$('.smmprovider-info-container').find('span').eq(0).find('span').eq(0).html(resultJson.smmservice_provider_user[0].activity);--}}
                        {{--// alert(resultJson.smmservices_unique[0].business_mark_name)--}}
                        {{--smmservices_uniqueToAdd='';--}}
                        {{--for (let i = 0; i < resultJson.smmservices_unique.length; i++) {--}}
                            {{--smmservices_uniqueToAdd+='<div class="smm_customer" style=" white-space: nowrap; width: auto"> '+--}}
                                {{--resultJson.smmservices_unique[i].business_mark_name+'<a onclick="smm_customer_link_handler(this); return false;" href="'+--}}
                                {{--'{{url(" ")}}'.trim()+resultJson.smmservice_provider_user[0].email+'/analyse/'+resultJson.smmservices_unique[i].business_mark_id+--}}
                                {{--'" style="text-decoration-line:none;" > '+--}}
                                {{--'  Performans Dəyərləndirməsinə Bax </a></div>'--}}
                        {{--}--}}
                        {{--$('.smm_customers').append(smmservices_uniqueToAdd);--}}

                        {{--$('.smmprovider-loading').css('display','none');--}}
                        {{--$('html, body').animate({scrollTop: '0px'},200);--}}
                        {{--$('.smmprovider-info-container').css('display','inherit');--}}
                        {{--$('.smm_customers').css('display','inherit')--}}
                    {{--}--}}
                {{--}--}}
            {{--});--}}

            {{--// $.getJSON( $(this).find('a').eq(0).attr('href')", function( data ) {--}}
            {{--//     var items = [];--}}
            {{--//     $.each( data, function( key, val ) {--}}
            {{--//         items.push( "<li id='" + key + "'>" + val + "</li>" );--}}
            {{--//     });--}}
            {{--//--}}
            {{--//     $( "<ul/>", {--}}
            {{--//         "class": "my-new-list",--}}
            {{--//         html: items.join( "" )--}}
            {{--//     }).appendTo( "body" );--}}
            {{--// });--}}
            {{--return false;--}}
        {{--});--}}

    // <button type="button">asaas</button>

        // smmprovider-work-container

        // $(".form").validate({
        //     rules: {
        //         // simple rule, converted to {required:true}
        //         name: {
        //             required: true,
        //             email: true
        //         },
        //         // compound rule
        //         email: {
        //             required: true,
        //             email: true
        //         },
        //         profile_image: {
        //             required: true,
        //             extension: "jpeg|png|jpg|gif|svg"
        //             // required|mimes:jpeg,png,|max:2048
        //         },
        //         password : {
        //             required: true,
        //             maxlength: 255,
        //             minlength : 5
        //         },
        //         password_confirmation : {
        //             required: true,
        //             maxlength: 255
        //             minlength : 5,
        //             equalTo : "password"
        //         },
        //
        //         activity: 'required',
        //
        //         sector: 'required',
        //
        //         city:  'required'
        //     },
        //     messages: {
        //
        //         name: {
        //             required: "Please enter name",
        //             maxlength: "Your last name maxlength should be 50 characters long.",
        //             email: "Please enter valid email"
        //         },
        //         mobile_number: {
        //             required: "Please enter contact number",
        //             minlength: "The contact number should be 10 digits",
        //             digits: "Please enter only numbers",
        //             maxlength: "The contact number should be 10 digits",
        //         },
        //         email: {
        //             required: "Please enter valid email",
        //             email: "Please enter valid email",
        //             maxlength: "The email name should less than or equal to 50 characters",
        //         },
        //
        //     },
        // });
        // $( "name" ).focusout(function() {
        //     $( "#focus-count" ).text( "focusout fired: " + focus + "x" );
        //     var alphanumeric = "someStringHere";
        //     var myRegEx  = /[^a-z\d]/i;
        //     var isValid = !(myRegEx.test(alphanumeric));
        // })
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

        // $.getJSON( $(this).find('a').eq(0).attr('href')", function( data ) {
        //     var items = [];
        //     $.each( data, function( key, val ) {
        //         items.push( "<li id='" + key + "'>" + val + "</li>" );
        //     });
        //
        //     $( "<ul/>", {
        //         "class": "my-new-list",
        //         html: items.join( "" )
        //     }).appendTo( "body" );
        // });
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
                    // var asset = new asset(item.Type, item.Url, $.parseJSON(jqXHR.responseText))
                    // alert(jqXHR.responseText);
                    resultJson=$.parseJSON(jqXHR.responseText)
                    $('.smmprovider-work-container'+sufixtoAdd).find('p').html('"'+resultJson.smmmservice_work[0].business_mark_name+'" Sosial Media Marketing Performans Dəyərləndirməsi')
                    {{--$('.smmprovider-work-container').find('span').eq(0).find('span').eq(0).html(resultJson.smmservice_provider_user[0].activity);--}}
                    {{--// alert(resultJson.smmservices_unique[0].business_mark_name)--}}
                    {{--smmservices_uniqueToAdd='';--}}
                    {{--for (let i = 0; i < resultJson.smmservices_unique.length; i++) {--}}
                    {{--smmservices_uniqueToAdd+='<div class="smm_customer" style=" white-space: nowrap; width: auto"> '+--}}
                    {{--resultJson.smmservices_unique[i].business_mark_name+'<a href="'+--}}
                    {{--'{{url(" ")}}'.trim()+resultJson.smmservice_provider_user[0].email+'/analyse/'+resultJson.smmservices_unique[i].business_mark_id+--}}
                    {{--'" style="text-decoration-line:none;"> '+--}}
                    {{--'  Performans Dəyərləndirməsinə Bax </a></div>'--}}
                    {{--}--}}
                    {{--$('.smm_customers').append(smmservices_uniqueToAdd);--}}

                    $('.smmprovider-loading'+sufixtoAdd).css('display','none');
                    $('html, body').animate({scrollTop: '0px'},200);
                    $('.smmprovider-work-container'+sufixtoAdd).css('display','inherit');
                    //bu ikisi modali acir 1ci defe
                    // $('.smmprovider-work-container > a').attr('data-toggle','modal')
                    // $('.smmprovider-work-container > a').attr('data-target','.bd-example-modal-lg')

                    if(sufixtoAdd==2){
                        $('#myModal1').modal('hide');

                        $('.smmprovider-work-compare-container').find('p').html('"'+resultJson.smmmservice_work[0].business_mark_name+'" Sosial Media Marketing Performans Dəyərləndirməsi')
                        $('.smmprovider-work-compare-container').css('display','inherit');
                        // // $('button.close').trigger('click');
                        // $('body').removeClass('modal-open');
                        // $('.modal-backdrop').remove();
                        // $('#myModal1').modal('toggle')
                    {{--<div class="col smmprovider-work-compare-container text-center" style="display: none;">--}}
                            {{--<p style=" font-size:20px; ">"Mega Fun Əyləncə Mərkəzi" Sosial Media Marketing Performans Dəyərləndirməsi</p>--}}
                        {{--<span> <img style="margin-left: auto;margin-right: auto; display: block;" src="{{asset('images/performance.jpg')}}"></span>--}}
                                {{--margin-left: 15%;--}}
                            {{--<a style="" href="#" class="btn btn-dark compare_link" onclick="compare_link_handler(this); return false;" data-toggle="modal" data-target=".bd-example-modal-lg">--}}
                            {{--Digəri ilə Müqayisə Et--}}
                        {{--<input style=" " type="submit" name="Digəri ilə Müqayisə Et" value="Digəri ilə Müqayisə Et">--}}
                        {{--</a>--}}
                        {{--margin-left: 15%--}}
                        {{--</div>--}}
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
        // $('#myModal1').modal('toggle')
        $('#myModal1').modal('show')
        {{--if(!$(element).attr('data-toggle')){--}}
            {{--$(element).attr('data-toggle','modal')--}}
            {{--$(element).attr('data-target','.bd-example-modal-lg')--}}
            {{--$(element).html(--}}
                {{--"                    <a style=\"\" href=\"#\" class=\"btn btn-dark compare_link\" onclick=\"compare_link_handler(this); return false;\" data-toggle=\"modal\" data-target=\".bd-example-modal-lg\">\n" +--}}
                {{--"                        Digəri ilə Müqayisə Et\n" +--}}
                {{--"                        --}}{{----}}{{--<input style=\" \" type=\"submit\" name=\"Digəri ilə Müqayisə Et\" value=\"Digəri ilə Müqayisə Et\">--}}{{----}}{{--\n" +--}}
                {{--"                    </a>"--}}
            {{--).--}}
            {{--$(element).find('a').trigger( "click" );--}}
        {{--}--}}
        // alert($(element).parent().find('p').text())
        // e.preventDefault();
        // return false
        {{--$('.smmprovider-info-container').css('display','none');--}}
        {{--$('.smm_customers').css('display','none')--}}

        {{--// $('.smmprovider-info-container').find('')--}}


        {{--$('.smmprovider-loading').css('display','initial');--}}
        {{--$.ajaxSetup({--}}
            {{--headers: {--}}
                {{--'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')--}}
            {{--}--}}
        {{--});--}}
        {{--$.ajax({--}}
            {{--url: ""+$(element).attr('href'),--}}
            {{--method: 'get',--}}
            {{--data: {--}}
                {{--"_token": "{{ csrf_token() }}"--}}
            {{--},--}}
            {{--success: function(result){--}}

            {{--},--}}
            {{--complete: function (jqXHR,status) {--}}
                {{--if(status == 'success' || status=='notmodified')--}}
                {{--{--}}
                    {{--// var asset = new asset(item.Type, item.Url, $.parseJSON(jqXHR.responseText))--}}
                    {{--alert(jqXHR.responseText);--}}
                    {{--resultJson=$.parseJSON(jqXHR.responseText)--}}
                    {{--$('.smmprovider-work-container').find('p').html('"'+resultJson.+'" Sosial Media Marketing Performans Dəyərləndirməsi')--}}
                    {{--$('.smmprovider-work-container').find('span').eq(0).find('span').eq(0).html(resultJson.smmservice_provider_user[0].activity);--}}
                    {{--// alert(resultJson.smmservices_unique[0].business_mark_name)--}}
                    {{--smmservices_uniqueToAdd='';--}}
                    {{--for (let i = 0; i < resultJson.smmservices_unique.length; i++) {--}}
                        {{--smmservices_uniqueToAdd+='<div class="smm_customer" style=" white-space: nowrap; width: auto"> '+--}}
                            {{--resultJson.smmservices_unique[i].business_mark_name+'<a href="'+--}}
                            {{--'{{url(" ")}}'.trim()+resultJson.smmservice_provider_user[0].email+'/analyse/'+resultJson.smmservices_unique[i].business_mark_id+--}}
                            {{--'" style="text-decoration-line:none;"> '+--}}
                            {{--'  Performans Dəyərləndirməsinə Bax </a></div>'--}}
                    {{--}--}}
                    {{--$('.smm_customers').append(smmservices_uniqueToAdd);--}}

                    {{--$('.smmprovider-loading').css('display','none');--}}
                    {{--$('html, body').animate({scrollTop: '0px'},200);--}}
                    {{--$('.smmprovider-work-container').css('display','inherit');--}}
                {{--}--}}
            {{--}--}}
        {{--});--}}
    }
    function get_ServiceProvidersForEntrepreneurAJAX(element,secondOrMain) {
        sufixtoAdd=''
        if(secondOrMain==2){sufixtoAdd=2;}
        else{sufixtoAdd='';}
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
                    // alert(divtoadd)
                    // $('.comparision-container2').val(divtoadd)
                    {{--for (var i = 0; i < resultJson.smmservice_provider_users.length; i++) {--}}
                        {{--divtoadd='<div class="smmservice_provider_user2">'+--}}
                            {{--'<img  style="margin-left: 9px" width="6%" src="{{asset('storage/avatars/')}}'+'/'+resultJson.smmservice_provider_users[i].profile_image+'"><br>'+--}}
                            {{--'<a  style="text-decoration-line: none;" href="{{url('user/')}}'+'/'+resultJson.smmservice_provider_users[i].email+'"><span style= "margin-left: 9px;"> '+resultJson.smmservice_provider_users[i].name+'  </span> </a>'+--}}
                            {{--'</div>';--}}
                        {{--if(resultJson.smmservice_provider_users[i].customer_type=='Agency'){--}}
                            {{--divtoaddAgency+=divtoadd--}}
                        {{--}--}}
                        {{--else if(resultJson.smmservice_provider_users[i].customer_type=='Freelancer'){--}}
                            {{--divtoaddFreelancer+=divtoadd--}}
                        {{--}--}}

                        {{--// alert(jqXHR.responseText);--}}
                    {{--}--}}
                    // $('.comparision-container2').html(divtoaddAgency);
                    {{--$('.comparision-container2').html('<div class="smmservice_provider_user2">'+--}}
                        {{--'<img  style="margin-left: 9px" width="6%" src="{{asset('storage/avatars/')}}'+'/'+resultJson.smmservice_provider_users[0].profile_image+'"><br>'+--}}
                        {{--'<a  style="text-decoration-line: none;" href="{{url('user/')}}'+'/'+resultJson.smmservice_provider_users[0].email+'"><span style= "margin-left: 9px;"> '+resultJson.smmservice_provider_users[0].name+'  </span> </a>'+--}}
                        {{--'</div>');--}}
                    // $('.comparision-container2').html(divtoaddFreelancer+divtoaddAgency)
                    // $(this).data('modal').$element.removeData();

                    {{--$('.smmprovider-work-container').find('p').html('"'+resultJson.smmmservice_work[0].business_mark_name+'" Sosial Media Marketing Performans Dəyərləndirməsi')--}}
                    {{--$('.smmprovider-work-container').find('span').eq(0).find('span').eq(0).html(resultJson.smmservice_provider_user[0].activity);--}}
                    {{--// alert(resultJson.smmservices_unique[0].business_mark_name)--}}
                    {{--smmservices_uniqueToAdd='';--}}
                    {{--for (let i = 0; i < resultJson.smmservices_unique.length; i++) {--}}
                    {{--smmservices_uniqueToAdd+='<div class="smm_customer" style=" white-space: nowrap; width: auto"> '+--}}
                    {{--resultJson.smmservices_unique[i].business_mark_name+'<a href="'+--}}
                    {{--'{{url(" ")}}'.trim()+resultJson.smmservice_provider_user[0].email+'/analyse/'+resultJson.smmservices_unique[i].business_mark_id+--}}
                    {{--'" style="text-decoration-line:none;"> '+--}}
                    {{--'  Performans Dəyərləndirməsinə Bax </a></div>'--}}
                    {{--}--}}
                    {{--$('.smm_customers').append(smmservices_uniqueToAdd);--}}

                    {{--$('.smmprovider-loading').css('display','none');--}}
                    {{--$('html, body').animate({scrollTop: '0px'},200);--}}
                    {{--$('.smmprovider-work-container').css('display','inherit');--}}
                    {{--$('.smmprovider-work-container > a').attr('data-toggle','modal')--}}
                    {{--$('.smmprovider-work-container > a').attr('data-target','.bd-example-modal-lg')--}}
                }
            }
        });
    }
</script>