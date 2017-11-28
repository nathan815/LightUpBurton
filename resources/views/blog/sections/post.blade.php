<div class="post content-box with-header">
  <div class="content-box-header">
    <h3>
      @if (!isset($post['viewing']))
      <a href="/blog/{{ $post['slug'] }}">{{ $post['title'] }}</a>
      @else
      {{ $post['title'] }}
      @endif
    </h3>
  </div>
  <div class="content-box-content">
    <div class="post-info">
      <small>
        <span class="glyphicon glyphicon-time"></span>
        <a href="/blog/{{ $post['slug'] }}">{{ $post['createdAtReadable'] }}</a>
      </small>
      <small>
        <span class="glyphicon glyphicon-user"></span>
        John Doe
      </small>
      <small>
        <span class="glyphicon glyphicon-tag"></span>
        Uncategorized
      </small>
    </div>

    <div class="post-content">{!! $post['body'] !!}</div>
  </div>
</div>