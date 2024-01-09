 <table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID NO.</th>
            <th>CATEGORY</th>
            <th>PRODUCT IMAGE</th>
            <th>SKU NAME</th>
            <th>SKU NO.</th>
            <th>SELLING PRICE</th>
            <th>STOCK BALANCE</th>
            <th>{{ trans('labels.Action') }}</th>
        </tr>
    </thead>
        <tbody>
            @if($result)
                <?php
                    if ($result->products_type == '0' || $result->products_type == '1' || $result->products_type == '3') {
                        $stocks = DB::table('inventory')->where('products_id', $result->products_id)->where('stock_type', 'in')->sum('stock');
                        $stockOut = DB::table('inventory')->where('products_id', $result->products_id)->where('stock_type', 'out')->sum('stock');
                        $defaultStock = $stocks - $stockOut;
                    }else{
                        $defaultStock = '0';
                    }
                    ?>
                <tr>
                    <td>1</td>
                    <td>{{$result->categories_name}}</td>
                    <td>{{$result->products_name}}</td>
                    <td><img src="{{$result->path}}" style="width: 50px;height: 50px;"></td>
                    <td>{{$result->product_sku}}</td>
                    <td>{{$result->products_price}}</td>
                    <td>{{$defaultStock}}</td>
                    <td><a href="javascript:;" onclick="loadDynamicContentModalStock({{$result->products_id}})"  type="button" class="btn btn-block btn-primary">View</a></td>
                </tr>
                @else
                <tr>
                    <td colspan="7">{{ trans('labels.NoRecordFound') }}</td>
                </tr>
                @endif
        </tbody>
 </table>