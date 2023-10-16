<div class="container mt-5">
    @foreach ($blog as $page)
    <div class="card mb-4">
        <div class="card-header">
            <div><b>{{ $page['header'] }}</b></div>
        </div>
        <div class="card-body">
            <div class="card-text">
                <div v-pre>{!! $page['text'] !!}</div>
            </div>
            <a href="page/{{ $page['link'] }}/" class="btn btn-primary mt-3">Go to Link</a>
        </div>
        <div class="card-footer text-muted">
            <p>Updated: {{ $page['updated_at'] }}</p>
        </div>
    </div>
    @endforeach
</div>



<style>
.card-text {
    max-height: 20em; /* Замените на желаемую максимальную высоту */
    overflow: hidden;
    position: relative;
}

.card-text:after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 2em; /* Высота последней строки текста */
}


</style>

<!-- style="max-height: 5.5em; overflow: hidden; text-overflow: ellipsis; white-space: normal;" -->