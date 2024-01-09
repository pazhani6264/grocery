<!DOCTYPE html>
<html style="background: #ebebeb;">
  <head>
    <title>REVIEW ORDER</title>
    <meta charset="utf-8">
    <meta name="description" content="QRCODE Scanning">
    <meta name="keywords" content="QRCODE Scanning">
    <meta name="author" content="Platinum Code">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name = "viewport" content = "width=device-width, minimum-scale=1.0, maximum-scale = 1.0, user-scalable = no">
    @php
      $color_style = DB::table('settings')->where('id',236)->first();
      $color = DB::table('settings')->where('id',237)->first();
      $country_id = DB::table('settings')->where('id',235)->first();
      $tax_class = DB::table('settings')->where('id',234)->first();
      $inv = DB::table('settings')->where('id',145)->first();

      if(session('language_id') == '')
      {
        $language_id = 1;
      }
      else
      {
        $language_id = session('language_id');
      }
      $label1 = DB::table('table_label_value')->where('label_id',2)->where('language_id', '=', $language_id)->first();
      $label2 = DB::table('table_label_value')->where('label_id',20)->where('language_id', '=', $language_id)->first();
      $label3 = DB::table('table_label_value')->where('label_id',21)->where('language_id', '=', $language_id)->first();
      $label4 = DB::table('table_label_value')->where('label_id',22)->where('language_id', '=', $language_id)->first();
    @endphp
       
    <link rel="stylesheet" type="text/css" href="{{asset('web/table').'/'.$color_style->value}}.css">
    <link rel="stylesheet" href="{{asset('web/table/font-awesome/css/all.min.css')}}">
    <script src="https://js.stripe.com/v3/"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('web/css/stripe.css') }}" data-rel-css="" />
  </head>
  <body>
    <style>
    
      body
      {
        background: #ebebeb;
      }
      .image-outer
      {
        text-align: center;
        margin-top: 15%;
      }
      .circle-image
      {
        width: 8rem;
        height: 8rem;
        border-radius: 50%;
      }
      .content-outer {
        margin-top: 5%;
        text-align: center;
      }
      .p1
      {
        color: #777;
        width: 85%;
        margin: auto;
      }
      .h1
      {
        margin-bottom: 2%;
      }
      
      .input-container-inner {
       
          background: #fff;
          border-radius: 10px;
          width: 85%;
          margin: auto;
          padding: 20px;
      }
      .input-container-outer {
        margin-top: 5%;
      }
      .input-container {
    display: flex;
    align-items: center;
    border: solid 1px #777;
    height: 40px;
    border-radius: 5px;
    position:relative;
  }
  .country-code {
    width: 80px; /* Adjust the width as needed */
    margin-right: 10px;
    width: 80px;
    margin-right: 10px;
    border: none !important;
    height: 90%;
    outline: none !important;
  }


  .phone-number {
    flex: 1;
    border: none !important;
    height: 90%;
    outline: none !important;
  }
  .logout-btn
{
padding: 10px 25px;

width: 100%;
    margin: auto;
    border-radius: 30px;
    color: #fff;
    margin-top: 20px;
    text-align: center
}

    </style>

    <h1 class="pc-title mobile-none">This Site Only View on Mobile And Tab</h1>
    <div class="pc-mobile-tab"> <a href="javascript:history.back()">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="common-text" style="margin-left: 10px;margin-top: 20px;" viewBox="0 0 24 24"><g id="evaArrowBackFill0"><g id="evaArrowBackFill1"><path id="evaArrowBackFill2" fill="currentColor" d="M19 11H7.14l3.63-4.36a1 1 0 1 0-1.54-1.28l-5 6a1.19 1.19 0 0 0-.09.15c0 .05 0 .08-.07.13A1 1 0 0 0 4 12a1 1 0 0 0 .07.36c0 .05 0 .08.07.13a1.19 1.19 0 0 0 .09.15l5 6A1 1 0 0 0 10 19a1 1 0 0 0 .64-.23a1 1 0 0 0 .13-1.41L7.14 13H19a1 1 0 0 0 0-2Z"/></g></g></svg></a>
      <div class="image-outer">
          <img class="circle-image" src="{{ asset('images/user.png') }}" alt="">
      </div>
      <div class="content-outer">


        <h3 class="h1">{{$label1->label_value}}</h3>
        <p class="p1">Add Your Registered Phone number. we'll send you a verification code so we know you're real</p>
      </div>
      <div class="input-container-outer">
        <div class="input-container-inner">  
        <div style="color:red;font-size:1rem;text-align:center;margin-bottom:15px;" id="phoneres"></div>
          <div class="input-container">
     
            <select class="country-code" name="ccode" id="ccode">
              <!-- Country names and Phone Code -->

              <option value="60" selected>+60 Malaysia</option>
              <option value="65">+65 Singapore</option>
              <option value="86">+86 China</option>
              <option value="66">+66 Thailand</option>
              <option value="62">+62 Indonesia</option>
              <option value="63">+63 Philippines</option>
              <option value="855">+855 Cambodia</option>
              <option value="91">+91 India</option>

              <option value="93">+93 Afghanistan</option>
              <option value="358">+358 Aland Islands</option>
              <option value="355">+355 Albania</option>
              <option value="213">+213 Algeria</option>
              <option value="1684">+1684 American Samoa</option>
              <option value="376">+376 Andorra</option>
              <option value="244">+244 Angola</option>
              <option value="1264">+1264 Anguilla</option>
              <option value="672">+672 Antarctica</option>
              <option value="1268">+1268 Antigua and Barbuda</option>
              <option value="54">+54 Argentina</option>
              <option value="374">+374 Armenia</option>
              <option value="297">+297 Aruba</option>
              <option value="61">+61 Australia</option>
              <option value="43">+43 Austria</option>
              <option value="994">+994 Azerbaijan</option>
              <option value="1242">+1242 Bahamas</option>
              <option value="973">+973 Bahrain</option>
              <option value="880">+880 Bangladesh</option>
              <option value="1246">+1246 Barbados</option>
              <option value="375">+375 Belarus</option>
              <option value="32">+32 Belgium</option>
              <option value="501">+501 Belize</option>
              <option value="229">+229 Benin</option>
              <option value="1441">+1441 Bermuda</option>
              <option value="975">+975 Bhutan</option>
              <option value="591">+591 Bolivia</option>
              <option value="599">+599 Bonaire, Sint Eustatius and Saba</option>
              <option value="387">+387 Bosnia and Herzegovina</option>
              <option value="267">+267 Botswana</option>
              <option value="55">+55 Bouvet Island</option>
              <option value="55">+55 Brazil</option>
              <option value="246">+246 British Indian Ocean Territory</option>
              <option value="673">+673 Brunei Darussalam</option>
              <option value="359">+359 Bulgaria</option>
              <option value="226">+226 Burkina Faso</option>
              <option value="257">+257 Burundi</option>
             
              <option value="237">+237 Cameroon</option>
              <option value="1">+1 Canada</option>
              <option value="238">+238 Cape Verde</option>
              <option value="1345">+1345 Cayman Islands</option>
              <option value="236">+236 Central African Republic</option>
              <option value="235">+235 Chad</option>
              <option value="56">+56 Chile</option>
             
              <option value="61">+61 Christmas Island</option>
              <option value="672">+672 Cocos (Keeling) Islands</option>
              <option value="57">+57 Colombia</option>
              <option value="269">+269 Comoros</option>
              <option value="242">+242 Congo</option>
              <option value="242">+242 Congo, Democratic Republic of the Congo</option>
              <option value="682">+682 Cook Islands</option>
              <option value="506">+506 Costa Rica</option>
              <option value="225">+225 Cote D'Ivoire</option>
              <option value="385">+385 Croatia</option>
              <option value="53">+53 Cuba</option>
              <option value="599">+599 Curacao</option>
              <option value="357">+357 Cyprus</option>
              <option value="420">+420 Czech Republic</option>
              <option value="45">+45 Denmark</option>
              <option value="253">+253 Djibouti</option>
              <option value="1767">+1767 Dominica</option>
              <option value="1809">+1809 Dominican Republic</option>
              <option value="593">+593 Ecuador</option>
              <option value="20">+20 Egypt</option>
              <option value="503">+503 El Salvador</option>
              <option value="240">+240 Equatorial Guinea</option>
              <option value="291">+291 Eritrea</option>
              <option value="372">+372 Estonia</option>
              <option value="251">+251 Ethiopia</option>
              <option value="500">+500 Falkland Islands (Malvinas)</option>
              <option value="298">+298 Faroe Islands</option>
              <option value="679">+679 Fiji</option>
              <option value="358">+358 Finland</option>
              <option value="33">+33 France</option>
              <option value="594">+594 French Guiana</option>
              <option value="689">+689 French Polynesia</option>
              <option value="262">+262 French Southern Territories</option>
              <option value="241">+241 Gabon</option>
              <option value="220">+220 Gambia</option>
              <option value="995">+995 Georgia</option>
              <option value="49">+49 Germany</option>
              <option value="233">+233 Ghana</option>
              <option value="350">+350 Gibraltar</option>
              <option value="30">+30 Greece</option>
              <option value="299">+299 Greenland</option>
              <option value="1473">+1473 Grenada</option>
              <option value="590">+590 Guadeloupe</option>
              <option value="1671">+1671 Guam</option>
              <option value="502">+502 Guatemala</option>
              <option value="44">+44 Guernsey</option>
              <option value="224">+224 Guinea</option>
              <option value="245">+245 Guinea-Bissau</option>
              <option value="592">+592 Guyana</option>
              <option value="509">+509 Haiti</option>
              <option value="39">+39 Holy See (Vatican City State)</option>
              <option value="504">+504 Honduras</option>
              <option value="852">+852 Hong Kong</option>
              <option value="36">+36 Hungary</option>
              <option value="354">+354 Iceland</option>
            
              
              <option value="98">+98 Iran, Islamic Republic of</option>
              <option value="964">+964 Iraq</option>
              <option value="353">+353 Ireland</option>
              <option value="44">+44 Isle of Man</option>
              <option value="972">+972 Israel</option>
              <option value="39">+39 Italy</option>
              <option value="1876">+1876 Jamaica</option>
              <option value="81">+81 Japan</option>
              <option value="44">+44 Jersey</option>
              <option value="962">+962 Jordan</option>
              <option value="7">+7 Kazakhstan</option>
              <option value="254">+254 Kenya</option>
              <option value="686">+686 Kiribati</option>
              <option value="850">+850 Korea, Democratic People's Republic of</option>
              <option value="82">+82 Korea, Republic of</option>
              <option value="383">+383 Kosovo</option>
              <option value="965">+965 Kuwait</option>
              <option value="996">+996 Kyrgyzstan</option>
              <option value="856">+856 Lao People's Democratic Republic</option>
              <option value="371">+371 Latvia</option>
              <option value="961">+961 Lebanon</option>
              <option value="266">+266 Lesotho</option>
              <option value="231">+231 Liberia</option>
              <option value="218">+218 Libyan Arab Jamahiriya</option>
              <option value="423">+423 Liechtenstein</option>
              <option value="370">+370 Lithuania</option>
              <option value="352">+352 Luxembourg</option>
              <option value="853">+853 Macao</option>
              <option value="389">+389 Macedonia, the Former Yugoslav Republic of</option>
              <option value="261">+261 Madagascar</option>
              <option value="265">+265 Malawi</option>
            
              <option value="960">+960 Maldives</option>
              <option value="223">+223 Mali</option>
              <option value="356">+356 Malta</option>
              <option value="692">+692 Marshall Islands</option>
              <option value="596">+596 Martinique</option>
              <option value="222">+222 Mauritania</option>
              <option value="230">+230 Mauritius</option>
              <option value="262">+262 Mayotte</option>
              <option value="52">+52 Mexico</option>
              <option value="691">+691 Micronesia, Federated States of</option>
              <option value="373">+373 Moldova, Republic of</option>
              <option value="377">+377 Monaco</option>
              <option value="976">+976 Mongolia</option>
              <option value="382">+382 Montenegro</option>
              <option value="1664">+1664 Montserrat</option>
              <option value="212">+212 Morocco</option>
              <option value="258">+258 Mozambique</option>
              <option value="95">+95 Myanmar</option>
              <option value="264">+264 Namibia</option>
              <option value="674">+674 Nauru</option>
              <option value="977">+977 Nepal</option>
              <option value="31">+31 Netherlands</option>
              <option value="599">+599 Netherlands Antilles</option>
              <option value="687">+687 New Caledonia</option>
              <option value="64">+64 New Zealand</option>
              <option value="505">+505 Nicaragua</option>
              <option value="227">+227 Niger</option>
              <option value="234">+234 Nigeria</option>
              <option value="683">+683 Niue</option>
              <option value="672">+672 Norfolk Island</option>
              <option value="1670">+1670 Northern Mariana Islands</option>
              <option value="47">+47 Norway</option>
              <option value="968">+968 Oman</option>
              <option value="92">+92 Pakistan</option>
              <option value="680">+680 Palau</option>
              <option value="970">+970 Palestinian Territory, Occupied</option>
              <option value="507">+507 Panama</option>
              <option value="675">+675 Papua New Guinea</option>
              <option value="595">+595 Paraguay</option>
              <option value="51">+51 Peru</option>
              
              <option value="64">+64 Pitcairn</option>
              <option value="48">+48 Poland</option>
              <option value="351">+351 Portugal</option>
              <option value="1787">+1787 Puerto Rico</option>
              <option value="974">+974 Qatar</option>
              <option value="262">+262 Reunion</option>
              <option value="40">+40 Romania</option>
              <option value="7">+7 Russian Federation</option>
              <option value="250">+250 Rwanda</option>
              <option value="590">+590 Saint Barthelemy</option>
              <option value="290">+290 Saint Helena</option>
              <option value="1869">+1869 Saint Kitts and Nevis</option>
              <option value="1758">+1758 Saint Lucia</option>
              <option value="590">+590 Saint Martin</option>
              <option value="508">+508 Saint Pierre and Miquelon</option>
              <option value="1784">+1784 Saint Vincent and the Grenadines</option>
              <option value="684">+684 Samoa</option>
              <option value="378">+378 San Marino</option>
              <option value="239">+239 Sao Tome and Principe</option>
              <option value="966">+966 Saudi Arabia</option>
              <option value="221">+221 Senegal</option>
              <option value="381">+381 Serbia</option>
              <option value="381">+381 Serbia and Montenegro</option>
              <option value="248">+248 Seychelles</option>
              <option value="232">+232 Sierra Leone</option>
             
              <option value="721">+721 Sint Maarten</option>
              <option value="421">+421 Slovakia</option>
              <option value="386">+386 Slovenia</option>
              <option value="677">+677 Solomon Islands</option>
              <option value="252">+252 Somalia</option>
              <option value="27">+27 South Africa</option>
              <option value="500">+500 South Georgia and the South Sandwich Islands</option>
              <option value="211">+211 South Sudan</option>
              <option value="34">+34 Spain</option>
              <option value="94">+94 Sri Lanka</option>
              <option value="249">+249 Sudan</option>
              <option value="597">+597 Suriname</option>
              <option value="47">+47 Svalbard and Jan Mayen</option>
              <option value="268">+268 Swaziland</option>
              <option value="46">+46 Sweden</option>
              <option value="41">+41 Switzerland</option>
              <option value="963">+963 Syrian Arab Republic</option>
              <option value="886">+886 Taiwan, Province of China</option>
              <option value="992">+992 Tajikistan</option>
              <option value="255">+255 Tanzania, United Republic of</option>
             
              <option value="670">+670 Timor-Leste</option>
              <option value="228">+228 Togo</option>
              <option value="690">+690 Tokelau</option>
              <option value="676">+676 Tonga</option>
              <option value="1868">+1868 Trinidad and Tobago</option>
              <option value="216">+216 Tunisia</option>
              <option value="90">+90 Turkey</option>
              <option value="7370">+7370 Turkmenistan</option>
              <option value="1649">+1649 Turks and Caicos Islands</option>
              <option value="688">+688 Tuvalu</option>
              <option value="256">+256 Uganda</option>
              <option value="380">+380 Ukraine</option>
              <option value="971">+971 United Arab Emirates</option>
              <option value="44">+44 United Kingdom</option>
              <option value="1">+1 United States</option>
              <option value="1">+1 United States Minor Outlying Islands</option>
              <option value="598">+598 Uruguay</option>
              <option value="998">+998 Uzbekistan</option>
              <option value="678">+678 Vanuatu</option>
              <option value="58">+58 Venezuela</option>
              <option value="84">+84 Viet Nam</option>
              <option value="1284">+1284 Virgin Islands, British</option>
              <option value="1340">+1340 Virgin Islands, U.s.</option>
              <option value="681">+681 Wallis and Futuna</option>
              <option value="212">+212 Western Sahara</option>
              <option value="967">+967 Yemen</option>
              <option value="260">+260 Zambia</option>
              <option value="263">+263 Zimbabwe</option>

   
            <!--   @if(!empty($code))
                @foreach($code as $jescode)
                  <option value="{{$jescode->country_code}}" >{{$jescode->country_code}}</option>
                @endforeach
              @endif -->
            </select>
              
              <input type="text" class="phone-number" id="customers_telephone" placeholder="" onkeydown="return ( event.ctrlKey || event.altKey
                          || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                          || (95<event.keyCode && event.keyCode<106)
                          || (event.keyCode==8) || (event.keyCode==9)
                          || (event.keyCode>34 && event.keyCode<40)
                          || (event.keyCode==46) )" maxlength="11" minlength="7" oninput="validateInput(this)">

                          <svg xmlns="http://www.w3.org/2000/svg" fill="#777" class="phone-check" style="position: absolute;right: 2%;" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10s10-4.5 10-10S17.5 2 12 2m-2 15l-5-5l1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9Z"/></svg>
            </div>

            <div class="logout-container">
            <div id="sendButton" class="common-bg logout-btn">Send</div>


        </div>
      </div>
     
      
    
    </div>

  </body>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>

function validateInput(inputElement) {
    const value = $('.phone-number').val();

   
    if (value.length >= 7 && value.length <= 11) {
      document.querySelector(".phone-check").setAttribute("fill", "green");
    } else {
      document.querySelector(".phone-check").setAttribute("fill", "#777");
    }
  }

  jQuery("#sendButton").click(function(){ 
   
    const value = $('.phone-number').val();

    if (value.length >= 7 && value.length <= 11) {
      document.querySelector(".phone-check").setAttribute("fill", "green");
      var ccode = jQuery("#ccode").val();
    var customers_telephone = jQuery("#customers_telephone").val();
    jQuery(function ($) {
      jQuery.ajax({
        headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
        url: '{{ URL::to("/table_login_process")}}',
        type: "POST",
        data: 'customers_telephone='+customers_telephone+'&ccode='+ccode,
        beforeSend: function() {
            $('#phoneres').html('loading ...');
        },
        success: function (res) {
          if(res == '1'){
              message = "Your Phone number not Registered. please try again with registered phone number!";
              jQuery('#phoneres').text(message);
             
          }  else{
             window.location.href = 'table_login_otp/'+res;
          }
        },
      });
    });

    } else {
            message = "Please enter valid Phone Number!";
            jQuery('#phoneres').text(message);
      document.querySelector(".phone-check").setAttribute("fill", "#777");
    }



  });
</script>
</html>



