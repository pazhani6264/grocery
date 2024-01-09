<style>
.brands:before {
    content: "";
    position: unset;
    left: 1rem;
    right: 1rem;
    top: 0;
    height: 0.1rem;
    background-color: #ebebeb;
}
.brand img {
    width: auto!important;
    max-width: 100%!important;
}
.mb-5 {
    margin-bottom: 5rem!important;
}
.brands .heading {
    margin-top: 6rem;
    margin-bottom: 4rem;
    text-align: center;
}
.brands .heading p.heading-cat {
    margin-bottom: 2.3rem;
}
.heading p.heading-cat {
    font-weight: 300;
    letter-spacing: .1em;
    color: #777;
    text-transform: uppercase;
    margin-bottom: 3rem;
}
.brands .heading p.heading-cat, .instagram .heading p.heading-cat, .subscribe .heading p.heading-cat {
    font-weight: 400;
}
.brands .heading h3.heading-title, .instagram .heading h3.heading-title, .subscribe .heading h3.heading-title {
    font-size: 1.55rem;
    text-transform: none;
    line-height: 1.7em;
}
.heading h3.heading-title {
    font-weight: 700;
    letter-spacing: .01em;
    color: #222;
    text-transform: uppercase;
}
.brands .brands-content {
    flex: 0 0 60%;
    max-width: 60%;
    display: flex;
    flex-wrap: wrap;
    margin-left: auto;
    margin-right: auto;
}
.brands a.brand {
    padding-top: 2rem;
    padding-bottom: 2rem;
}
.brand {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 8rem;
}


  </style>

<div id="getclientbrand_19_loading"></div>

  <div id="getclientbrand_19_product"></div>

  <script>
    getclientbrand_19();
    function getclientbrand_19() {
      var type = '18'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Brand</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getclientbrand_19_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getclientbrand_19")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getclientbrand_19_loading').html(' ');
              jQuery('#getclientbrand_19_product').html(res);
              var imgEl = document.getElementsByTagName('img');
              for (var i=0; i<imgEl.length; i++) {
                  if(imgEl[i].getAttribute('data-src')) {
                    imgEl[i].setAttribute('src',imgEl[i].getAttribute('data-src'));
                    imgEl[i].removeAttribute('data-src'); //use only if you need to remove data-src attribute after setting src
                  }
              }
          
        },
        });
} 


  </script>

 

 
