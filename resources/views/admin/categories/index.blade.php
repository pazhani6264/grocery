@extends('admin.layout')
@section('content')
<style>
    .section-show{
        display:inline-block;
    }
    .section-hide{
        display:none;
    }
    #deleteCategory{
        display:none;
    }
    #cloneCategory{
        display:none;
    }
    #multistatus{
        display:none;
    }
    #selectItem{
        display:none;
    }
</style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> {{ trans('labels.Categories') }} <small>{{ trans('labels.ListingAllMainCategories') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">{{ trans('labels.MainCategories') }}</li>
            </ol>
        </section>

        <!-- Main content -->
         <section class="content">
            <!-- Info boxes -->

            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="col-lg-6 form-inline">
                                <form  name='registration' id="registration1" class="registration1" method="get" action="{{url('admin/categories/filter')}}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="input-group-form search-panel ">
                                        <select type="button" id="search_filter" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="FilterBy" id="FilterBy" >
                                            <option value="" selected disabled hidden>{{trans('labels.Filter By')}}</option>
                                            <option value="Name"  @if(isset($name)) @if  ($name == "Name") {{ 'selected' }} @endif @endif>{{trans('labels.Name')}}</option>
                                            <option value="Status" @if(isset($name)) @if  ($name == "Status") {{ 'selected' }} @endif @endif>Status</option>
                                            <!-- <option value="Main"  @if(isset($name)) @if  ($name == "Main") {{ 'selected' }} @endif @endif>Main Category</option> -->
                                        </select>
<!-- 
                                        <input type="text" class="form-control input-group-form " name="parameter" placeholder="{{trans('labels.Search')}}..." id="parameter"  @if(isset($param)) value="{{$param}}" @endif > -->

                                    <div id="section1" class="section">
                                        <input type="text" style="width:200px;" class="form-control input-group-form " name="parameter" placeholder="{{trans('labels.Search')}}..." id="parameter"  @if(isset($param)) value="{{$param}}" @endif >

                                    </div>

                                    <div id="section2" class="section">
                                        <select type="text"  class="form-control input-group-form " name="parameter2" placeholder="{{trans('labels.Search')}}..." id="parameter2"  @if(isset($param2)) value="{{$param2}}" @endif >

                                        <option value="1" @if(isset($param2)) @if  ($param2 == "1") {{ 'selected' }} @endif @endif>Active</option>
                                        <option value="0" @if(isset($param2)) @if  ($param2 == "0") {{ 'selected' }} @endif @endif>Inactive</option>
                                        

                                        </select>
                                    </div>
                                    <div id="section3" class="section">
                                        <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                        @if(isset($name) || isset($status))  <a class="btn btn-danger " href="{{url('admin/categories/display')}}"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
                                    </div>
                                    </div>
                                </form>
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
                            </div>
                            <div class="box-tools pull-right">
                                <a href="{{ URL::to('admin/categories/add')}}" type="button" class="btn  btn-primary">{{ trans('labels.AddNewCategory') }}</a>
                                <a href="{{ URL::to('admin/categories/sorting')}}" type="button" class="btn btn-primary">Sorting</a>
                            </div>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
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


                            <div class="col-xs-8" style="margin: 0px 0px 20px 0;">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div id="selectItem">Selected Items ( <span id="totalCount"></span> )</div>
                                    </div>
                                    <div class="col-md-2">
                                        <button  type="button" class="btn btn-danger" id="deleteCategory">Delete Category</button>
                                    </div>
                                    <div class="col-md-2">
                                        <button  type="button" class="btn btn-warning" id="cloneCategory">Clone Category</button>
                                    </div>
                                    <span id="multistatus">
                                        <div class="col-md-2">
                                            <select class="form-control" id="categories_status" name="categories_status">
                                                <option value="1">{{ trans('labels.Active') }}</option>
                                                <option value="0">{{ trans('labels.Inactive') }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <button id="multiStatusBut" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                        </div>
                                    </span>
                                </div>
                            </div>

                            <div class="row" id="DesignationTable">
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th><input type="checkbox" name="Main_Checkbox_Category" class="mb-3" id='checkall'/></th>
                                            <th>@sortablelink('categories_id', trans('labels.ID') )</th>
                                            <th>{{ trans('labels.Name') }}</th>
                                            <th>{{ trans('labels.Image') }}</th>
                                            <th>{{ trans('labels.Icon') }}</th>
                                            <!-- <th>{{trans('labels.MainCategory')}}</th> -->
                                            <th>@sortablelink('created_at', trans('labels.AddedLastModifiedDate') )</th>
                                            <th>@sortablelink('status', trans('labels.Status'))</th>
                                            <th>{{ trans('labels.Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($categories)>0)
                                            @php $categoriesunique = $categories->unique('id'); @endphp
                                            @foreach ($categories as $key=>$category)
                                                    <tr id="{{ $category->id }}">
                                                        <td><input type="checkbox" class='category_checkbox' name="category_id[]" value="{{ $category->id }}"/></td>
                                                        <td>@if($category->id == -1) 0 @else {{ $category->id }} @endif</td>
                                                        <td>
                                                            @if($category->parent_name)
                                                                {{$category->parent_name}} /
                                                            @endif
                                                            {{ $category->name }}</td>
                                                        <td><img src="{{asset($category->imgpath)}}" alt="" width=" 100px"></td>
                                                        <td><img src="{{asset($category->iconpath)}}" alt="" width=" 100px"></td>
                                                        <td>
                                                            <strong>{{ trans('labels.AddedDate') }}: </strong> {{ $category->date_added }}<br>
                                                            <strong>{{ trans('labels.ModifiedDate') }}: </strong>{{ $category->last_modified }}
                                                        </td>
                                                        <td>
                                                          @if($category->categories_status==1)
                                                          <span class="label label-success">
                                                            {{ trans('labels.Active') }}
                                                          </span>
                                                          @elseif($category->categories_status==0)
                                                          <span class="label label-danger">
                                                              {{ trans('labels.InActive') }}
                                                          @endif
                                                        </td>
                                                        <td>
                                                            {!! Form::open(array('url' =>'/admin/categories/edit/'. $category->id, 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}

                                                            <input type="hidden" name="furl" value="{{ url()->full() }}"/>
                                                            <button style="border:none" type="submit" data-toggle="tooltip" data-placement="bottom" title="Edit" href="" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                            {!! Form::close() !!}

                                                            @if($category->id >0 )


                                                            <?php
                                                               
        $cat_delete = DB::table('categories')
        ->Join('products_to_categories', 'products_to_categories.categories_id', '=', 'categories.categories_id')
        ->Join('orders_products', 'orders_products.products_id', '=', 'products_to_categories.products_id')
        ->where('categories.categories_id', $category->id)
        ->get();





                                                                if(count($cat_delete) > 0)
                                                                {
                                                                }
                                                                else{
                                                                ?>
                                                            
                                                            <a id="delete" data-toggle="tooltip" data-placement="bottom" title="Delete" category_id="{{$category->id}}" href="#" class="badge bg-red " ><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                            <?php } ?>
                                                            
                                                            @endif
                                                        </td>
                                                    </tr>

                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7">{{ trans('labels.NoRecordFound') }}</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>

                                    @if($categories != null)
                                        <div class="col-xs-12 text-right">
                                            {!! $categories->appends(Request::except('page'))->links() !!}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteModalLabel">{{ trans('labels.Delete') }}</h4>
                        </div>
                        {!! Form::open(array('url' =>'admin/categories/delete', 'name'=>'deleteBanner', 'id'=>'deleteBanner', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                        {!! Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'category_id')) !!}
                        <div class="modal-body">
                            <p style="text-align: center;">All products will deleted for this Category</p>
                            <p style="text-align: center;color: red;">Are you sure you want to delete this record?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                            <button type="submit" class="btn btn-primary" id="deleteBanner">{{ trans('labels.Delete') }}</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <!-- Main row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

    <script src="{!! asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>
<script type="text/javascript">

$( "#registration" ).on('click','#submit',function( event ) {

var param =  $( "#parameter" ).val();
var select = $( "#FilterBy" ).val();

      //if( (select == null) || (param == "")) {
      if(param == "") {
          $( "#contact-form12" ).text( "fill the credentials!" ).css({'color':'red'}).show().fadeOut( 10000 );
          $( "#parameter" ).css({'border-color':'red'});
          $( "select" ).css({'border-color':'red'});
          event.preventDefault();
      }else {
        // $( "#contact-form12" ).text( "fill the credentials!" ).css({'padding-left':'10px','margin-right':'20px','padding-bottom':'2px', 'color':'red'}).show().fadeOut( 10000 );
        //     event.preventDefault();
      }
});

    var val  =$("#search_filter" ).val();

    getselectbox(val);

    $('#search_filter').on('change', function() {
        getselectbox(this.value);
});

    function getselectbox(val)
    {
        // if(val == 'Status')
        // {
        //     $("#parameter").hide();
        //     $("#parameter2").show();
        // }
        // else
        // {
        //     $("#parameter").show();
        //     $("#parameter2").hide();
        // }

        $(".section").removeClass("section-hide");
        $(".section").removeClass("section-show");
       
        if(val == 'Status')
        {
           
            $("#section1").addClass("section-hide");
            $("#section2").addClass("section-show");
            $("#section3").addClass("section-show");
        }
        else if(val == 'Name')
        {
            $("#section1").addClass("section-show");
            $("#section2").addClass("section-hide");
            $("#section3").addClass("section-show");
        }
        else
        {
            $("#section1").addClass("section-hide");
            $("#section2").addClass("section-hide");
            $("#section3").addClass("section-hide");
        }
        

    }
   
</script>

<script>

    $("#checkall").change(function() {
        var checked = $(this).is(":checked");
        if (checked) {
            $(".category_checkbox").each(function() {
                $(this).prop("checked", true);
            });
        } else {
            $(".category_checkbox").each(function() {
                $(this).prop("checked", false);
            });
        }
        var totalCount = $(".category_checkbox:checked").length;
        $("#totalCount").text(totalCount);
    });

    // Changing state of CheckAll checkbox
    $(".category_checkbox").click(function() {
        if ($(".category_checkbox").length == $(".category_checkbox:checked").length) {
            $("#checkall").prop("checked", true);
        } else {
            // $("#checkall").removeAttr("checked");
            $("#checkall").prop("checked", false);
        } 
        var totalCount = $(".category_checkbox:checked").length;
        $("#totalCount").text(totalCount);
    });

    $("#DesignationTable").on("click", function() {
        $("#deleteCategory").toggle($(this).find(".category_checkbox:checked").length > 0);
        $("#cloneCategory").toggle($(this).find(".category_checkbox:checked").length > 0);
        $("#multistatus").toggle($(this).find(".category_checkbox:checked").length > 0);
        $("#selectItem").toggle($(this).find(".category_checkbox:checked").length > 0);
    })

    $('input[name="Main_Checkbox_Category"]').on("click", function() {
        $('.category_checkbox').prop('checked', this.checked);
        $("#totalCount") = prop('checked', this.checked).length;
    });
</script>

<script>
    $(document).ready(function(){
		$("#multiStatusBut").click(function(){
			if(confirm("Are you sure ? Do you want to change the status")) {

                var categories_status  = $("#categories_status" ).val();

				var category_id = [];
				$('.category_checkbox:checked').each(function(i){
					category_id[i] = $(this).val();
				});
				if(category_id.length === 0) {
					alert ("please select atleast one");
				}
				else{
					$.ajax({
                        headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
                        url: "{{ URL::to('admin/categories/status_multiple')}}",
						type: 'POST',
                        data: 'category_id='+category_id+'&categories_status='+categories_status,
						success: function(){
							for(var i=0; i<category_id.length; i++){
						       $('tr#'+category_id[i]+'').css({'background-color': '#f60000','color':'#fff'});
						       //$('tr#'+category_id[i]+'').fadeIn('slow');
						    }
                            location.reload();
						}
					})
				}
			}
		});

        $("#deleteCategory").click(function(){
			if(confirm("Are you sure ? Do you want to delete the Category")) {
				var category_id = [];
				$('.category_checkbox:checked').each(function(i){
					category_id[i] = $(this).val();
				});
				if(category_id.length === 0) {
					alert ("please select atleast one");
				}
				else{
					$.ajax({
                        headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
                        url: "{{ URL::to('admin/categories/delete_multiple')}}",
						type: 'POST',
                        data: 'category_id='+category_id,
						success: function(){
							for(var i=0; i<category_id.length; i++){
						       $('tr#'+category_id[i]+'').css({'background-color': '#f60000','color':'#fff'});
						       $('tr#'+category_id[i]+'').fadeOut('slow');
						    }
                            location.reload();
						}
					})
				}
			}
		});

        $("#cloneCategory").click(function(){
			if(confirm("Are you sure ? Do you want to clone the Category")) {
				var category_id = [];
				$('.category_checkbox:checked').each(function(i){
					category_id[i] = $(this).val();
				});
				if(category_id.length === 0) {
					alert ("please select atleast one");
				}
				else{
					$.ajax({
                        headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
                        url: "{{ URL::to('admin/categories/clone_category')}}",
						type: 'POST',
                        data: 'category_id='+category_id,
						success: function(){
							for(var i=0; i<category_id.length; i++){
						       $('tr#'+category_id[i]+'').css({'background-color': '#f60000','color':'#fff'});
						       $('tr#'+category_id[i]+'').fadeOut('slow');
						    }
                            location.reload();
						}
					})
				}
			}
		});

	});
</script>
@endsection
