
<style>
.blog-layout {
    flex-direction: row;
    flex-wrap: wrap;
    display: flex;
}
.grid-article[data-style=compact] .grid-article__meta {
    flex: 0 0 60%;
    padding-left: 15px;
}
.article__sub-meta-date {
    text-transform: uppercase;
    font-size:12px;
}
.grid-article[data-style=large] .article__title {
    font-size: 24px;
}
.grid-article[data-style=compact] .article__title {
    font-size: 15px;
}

.blog-layout__main {
    flex: 1 1 calc(60% - 90px);
    margin-bottom: 20px;
}

.new-grid {
    display: flex;
    flex-wrap: wrap;
    margin-left: -10px;
    margin-right: -10px;
    word-break: break-word;
}
.grid-article:last-child {
    margin-bottom: 0;
}

.grid-article__image {
    position: relative;
    flex: 0 0 100%;
    margin-bottom: 15px;
}
.grid-article__meta {
    flex: 0 0 100%;
}
.article__sub-meta {
    opacity: .65;
}

.grid-article[data-style=compact] {
    flex: 0 0 100%;
    flex-wrap: nowrap;
    text-align: left;
    margin-bottom: 20px;
    padding: 0;
}
.grid-article {
    flex: 0 0 100%;
    display: flex;
    flex-wrap: wrap;
    text-align: center;
    margin-bottom: 40px;
}
.grid-item {
    flex: 0 0 100%;
    align-items: stretch;
    display: flex;
    margin-bottom: 10px;
    padding-left: 10px;
    padding-right: 10px;
}
.article__sub-meta>span {
    position: relative;
    display: inline-block;
    margin-bottom: 2px;
    margin-right: 10px;
}
.grid-article[data-style=compact] .grid-article__image {
    flex: 0 0 40%;
    align-self: flex-start;
}
.img_blog_main
{
  display:block;
  width:100%;
}

@media only screen and (min-width: 769px)
{
  .blog-layout__sidebar {
    order: 0;
    flex: 0 0 calc(40% - 90px);
    align-self: flex-start;
    padding-left: 0;
    margin-left: 0;
    border-left: 0;
    padding-right: 45px;
    margin-right: 45px;
    border-right: 1px solid;
    border-right-color: #e8e8e1;
}
.blog-layout__main+.blog-layout__sidebar {
    padding-right: 0;
    margin-right: 0;
    border-right: 0;
    padding-left: 45px;
    margin-left: 45px;
    border-left: 1px solid;
    border-left-color: #e8e8e1;
}
.blog-2-latest {
    margin-bottom: 20px;
    font-size: 17px;
    color: #000;
    font-weight: 700;
    letter-spacing: 0.5px;
}

}
@media only screen and (max-width: 768px)
{
.blog-layout {
    display: flex;
    flex-wrap: nowrap;
    flex-direction: column;
}
.grid-article[data-style=large] .article__title {
    font-size: 19px;
}

.grid-article[data-style=compact] .article__title {
    font-size: 13px;
}
.article__sub-meta-date {
    text-transform: uppercase;
    font-size:10px;
}
.blog-2-latest {
    margin-bottom: 15px;
}

}
</style>
<section class="blog-2">
  <div class="blog-2-outer-pad">
    <div class="blog-2-header">
      <h2 class="blog-2-title">Latest News</h2>
        <a href="{{url('/news')}}" class="blog-2-link">View all</a>
    </div>
    <?php $main_news = DB::table('news')
            ->leftJoin('images', 'images.id', '=', 'news.news_image')
            ->leftJoin('image_categories', 'image_categories.image_id', '=', 'news.news_image')
            ->leftJoin('image_categories as thumb', 'thumb.image_id', '=', 'news.news_thumb_image')
            ->leftJoin('news_description','news_description.news_id','=','news.news_id')
            ->select('news.*','image_categories.path as path' ,'thumb.path as thumb_path', 'image_categories.path_type as image_path_type', 'news_description.*')->where('image_categories.image_type', 'ACTUAL')->where('thumb.image_type', 'ACTUAL')->orderBy('news.news_id', 'Desc')
            ->first();

            $news_data = DB::table('news_to_news_categories')
			->LeftJoin('news', 'news.news_id', '=', 'news_to_news_categories.news_id')
			->LeftJoin('image_categories', 'news.news_image', '=', 'image_categories.image_id')
      ->leftJoin('image_categories as thumb', 'thumb.image_id', '=', 'news.news_thumb_image')
			->leftJoin('news_description','news_description.news_id','=','news.news_id')
			->select('news.*','image_categories.path as path' ,'thumb.path as thumb_path', 'image_categories.path_type as image_path_type', 'news_description.*')->where('image_categories.image_type', 'ACTUAL')->where('news_description.language_id','=',Session::get('language_id'))->where('thumb.image_type', 'ACTUAL')->orderBy('news.news_id', 'Desc')
      ->skip(1)->take(4)->get();

           ?>

            
    <div class="blog-layout">
      @if($main_news != '')
      <div class="blog-layout__main">
        <div class="new-grid">
          <div class="grid-item grid-article" data-style="large">
            <div class="grid-article__image">
              <a href="{{url('/news-detail/'.$main_news->news_slug)}}" aria-label="{{$main_news->news_name}}">
                <div class="image-wrap" style="height: 0; padding-bottom: 106.30000000000001%;">
                  <img class="img_blog_main" src="{{ asset($main_news->path)}}">
                </div>
              </a>
            </div>
            <div class="grid-article__meta">
              <a href="{{url('/news-detail/'.$main_news->news_slug)}}" class="article__title">{{$main_news->news_name}}</a>
              <div class="article__sub-meta">
                <span class="article__sub-meta-date">{{date('M d, Y', strtotime($main_news->created_at))}} 
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>  
      @endif
      @if(count($news_data) > 0)
     
      <div class="blog-layout__sidebar">
        <div class="h4 blog-2-latest">Latest posts</div>
        @foreach($news_data as $news)
          <div class="grid-item grid-article" data-style="compact">
            <div class="grid-article__image">
              <a href="{{url('/news-detail/'.$news->news_slug)}}" aria-label="{{$news->news_name}}">
                <div class="image-wrap" style="height: 0; padding-bottom: 100.0%;">
                  <img class="img_blog_main" src="{{ asset($news->thumb_path)}}">
                </div>
              </a>
            </div>
            <div class="grid-article__meta">
              <a href="{{url('/news-detail/'.$news->news_slug)}}" class="article__title">{{$news->news_name}}</a>
              <div class="article__sub-meta">
                <span class="article__sub-meta-date">
                  <time datetime="2022-08-04T08:27:49Z">{{date('M d, Y', strtotime($main_news->created_at))}} </time>
                </span>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        @endif
      </div>
     
     
  </div>
</section>