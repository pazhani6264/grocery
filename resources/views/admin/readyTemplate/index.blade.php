<style>
    
    .item-main-active {
    border: 1px solid #2ad32a;
    border-radius: 15px;
    -webkit-box-shadow: 0px 3px 10px 0px #2ad32a;
    -moz-box-shadow: 0px 3px 10px 0px #2ad32a;
    box-shadow: 0px 3px 10px 0px #2ad32a;
    margin: 10px 0px;
}

.item-main-active .item-img-main{
        border-bottom:2px solid #2ad32a;
        height:230px;
        border-top-left-radius:15px;
        border-top-right-radius:15px;
        overflow: hidden; 
    }

    .item-main{
        border:1px solid #b4b6b8d9;
        border-radius:15px;
        -webkit-box-shadow: 0px 3px 10px 0px rgba(212,210,212,1);
        -moz-box-shadow: 0px 3px 10px 0px rgba(212,210,212,1);
        box-shadow: 0px 3px 10px 0px rgba(212,210,212,1);
        margin:10px 0px;
    }
    .item-img-main{
        border-bottom:2px solid #d5d5d5d9;
        height:230px;
        border-top-left-radius:15px;
        border-top-right-radius:15px;
        overflow: hidden; 
    }
    .item-img{
        width:100%;
        height:auto;
        object-fit:initial;
        border-top-left-radius:15px;
        border-top-right-radius:15px;
        overflow: hidden; 
    }
    .item-content-main{
        padding:10px 20px;
        text-align:center;
    }
    .item-content-main h5{
        font-size:1.5rem;
        font-weight:600;
    }
    .item-content-demo-button{
        border:1px solid;
        padding:7px;
        background-color:#1f8dbfd9;
        color:#fff;
        font-weight:900;
        border-radius:20px;
        margin-top:20px;
        cursor:pointer;
    }
    .item-content-use-button-active{
        border:1px solid;
        padding:7px;
        background-color:#00e447d9;
        color:#fff;
        font-weight:900;
        border-radius:20px;
        margin-top:10px;
        cursor:pointer;
    }
    .item-content-use-button{
        border:1px solid;
        padding:7px;
        background-color:#dd4b39;
        color:#fff;
        font-weight:900;
        border-radius:20px;
        margin-top:10px;
        cursor:pointer;
    }
    .comming-item-main{
        border:1px solid #b4b6b8d9;
        border-radius:15px;
        -webkit-box-shadow: 0px 3px 10px 0px rgba(212,210,212,1);
        -moz-box-shadow: 0px 3px 10px 0px rgba(212,210,212,1);
        box-shadow: 0px 3px 10px 0px rgba(212,210,212,1);
        margin:10px 0px;
        height:380px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .comming-item-main h5{
        font-weight:900;
    }
    
    .item-img {
        transition: 0.3s;
    }
    .item-img:hover {
        transform: scale(1.1);
        /* border-top-left-radius:90px !important;
        border-top-right-radius:90px !important; */
    }
</style>

@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Ready Templates <small>Listing All The Ready Templates ...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">Ready Template</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Info boxes -->
            <!-- /.row -->
            <div class="row">
                <div class="col-xs-12">
                    @if (count($errors) > 0)
                        @if($errors->any())
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{$errors->first()}}
                            </div>
                        @endif
                    @endif

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">

                        <?php $current_theme = DB::table('current_theme')->where('id', '=', '1')->first(); ?>

                            <div class="col-lg-3">
                                <div class="@if($current_theme->template == 0) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo1.png" alt="TEMPLATE 1">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>CUSTOMIZE TEMPLATE</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-all"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 0)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/0"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                            <div class="@if($current_theme->template == 1) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo1.png" alt="TEMPLATE 1">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 1</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-1"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 1)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/1"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                            <div class="@if($current_theme->template == 2) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo2.png" alt="TEMPLATE 2">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 2</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-2"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 2)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/2"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                            <div class="@if($current_theme->template == 3) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo3.png" alt="TEMPLATE 3">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 3</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-3"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 3)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/3"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                            <div class="@if($current_theme->template == 4) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo4.png" alt="TEMPLATE 4">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 4</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-4"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 4)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/4"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                            <div class="@if($current_theme->template == 5) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo5.png" alt="TEMPLATE 5">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 5</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-5"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 5)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/5"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                            <div class="@if($current_theme->template == 6) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo6.png" alt="TEMPLATE 6">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 6</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-6"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 6)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/6"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                            <div class="@if($current_theme->template == 7) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo7.png" alt="TEMPLATE 7">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 7</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-7"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 7)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/7"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-3">
                            <div class="@if($current_theme->template == 8) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo8.png" alt="TEMPLATE 8">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 8</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-8"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 8)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/8"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-3">
                            <div class="@if($current_theme->template == 9) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo9.png" alt="TEMPLATE 9">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 9</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-9"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 9)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/9"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-3">
                            <div class="@if($current_theme->template == 10) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo10.png" alt="TEMPLATE 10">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 10</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-10"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 10)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/10"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                            <div class="@if($current_theme->template == 11) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo11.png" alt="TEMPLATE 11">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 11</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-11"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 11)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/11"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                            <div class="@if($current_theme->template == 12) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo12.png" alt="TEMPLATE 12">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 12</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-12"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 12)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/12"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                            <div class="@if($current_theme->template == 13) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo13.png" alt="TEMPLATE 13">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 13</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-13"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 13)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/13"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                            <div class="@if($current_theme->template == 14) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo14.png" alt="TEMPLATE 14">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 14</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-14"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 14)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/14"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="@if($current_theme->template == 15) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo15.png" alt="TEMPLATE 15">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 15</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-15"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 15)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/15"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="@if($current_theme->template == 16) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo16.png" alt="TEMPLATE 16">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 16</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-16"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 16)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/16"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="@if($current_theme->template == 17) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo17.png" alt="TEMPLATE 17">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 17</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-17"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 17)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/17"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="@if($current_theme->template == 18) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo18.png" alt="TEMPLATE 18">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 18</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-18"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 18)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/18"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="@if($current_theme->template == 19) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo19.png" alt="TEMPLATE 19">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 19</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-19"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 19)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/19"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-3">
                                 <div class="@if($current_theme->template == 20) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo20.png" alt="TEMPLATE 20">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 20</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-20"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 20)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/20"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="@if($current_theme->template == 21) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo21.png" alt="TEMPLATE 21">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 21</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-21"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 21)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/21"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="@if($current_theme->template == 22) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo22.png" alt="TEMPLATE 22">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 22</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-22"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 22)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/22"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="@if($current_theme->template == 23) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo23.png" alt="TEMPLATE 23">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 23</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-23"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 23)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/23"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="@if($current_theme->template == 24) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo24.png" alt="TEMPLATE 24">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 24</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-24"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 24)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/24"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="@if($current_theme->template == 25) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo25.png" alt="TEMPLATE 25">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 25</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-25"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 25)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/25"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="@if($current_theme->template == 26) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo26.png" alt="TEMPLATE 26">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 26</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-26"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 26)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/26"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="@if($current_theme->template == 27) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo27.png" alt="TEMPLATE 27">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 27</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-27"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 27)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/27"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="@if($current_theme->template == 28) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo28.png" alt="TEMPLATE 28">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 28</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-28"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 28)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/28"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="@if($current_theme->template == 29) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo29.png" alt="TEMPLATE 29">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 29</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-29"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 29)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/29"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="@if($current_theme->template == 30) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo30.png" alt="TEMPLATE 30">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 30</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-30"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 30)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/30"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="@if($current_theme->template == 31) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo31.png" alt="TEMPLATE 31">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 31</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-31"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 31)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/31"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="@if($current_theme->template == 32) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo32.png" alt="TEMPLATE 32">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 32</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-32"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 32)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/32"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="@if($current_theme->template == 33) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo33.png" alt="TEMPLATE 33">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 33</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-33"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 33)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/33"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="@if($current_theme->template == 34) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo34.png" alt="TEMPLATE 34">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 34</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-34"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 34)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/34"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="@if($current_theme->template == 35) item-main-active @else item-main @endif ">
                                    <div class="item-img-main">
                                        <img class="item-img" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/Demo35.png" alt="TEMPLATE 35">
                                    </div>
                                    <div class="item-content-main">
                                        <h5>TEMPLATE 35</h5>
                                        <a target="_blank" href="http://platinum24preview.com/demo-35"><div class="item-content-demo-button">VIEW DEMO</div></a>
                                        @if($current_theme->template == 35)
                                        <a target="_blank" href="/"><div class="item-content-use-button-active">GO TO WEBSITE</div></a>
                                        @else
                                        <a href="readytemplate_save/35"><div class="item-content-use-button">USE TEMPLATE</div></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                           
                            <div class="col-lg-3">
                                <div class="comming-item-main">
                                    <h5>COMMING SOON .....</h5>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-header -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection


<script src="{!! asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>


<script>

function dTemplate(id){  
    //  alert(id);    
        $.ajax({
            url: "readytemplate_demo//"+id,
            method:"GET",
            success: function (res) { 
                var url = "{{url('readytemplate_demo//"+id;
                window.open(url, "_blank");
            },
        }) 

}
</script>