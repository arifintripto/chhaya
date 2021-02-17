@section('title',$title)
@include('layouts.default.includes.page_header')
<section>
    <div class="container custom_pages">
            <?php echo $content; ?>
    </div>
</section>
