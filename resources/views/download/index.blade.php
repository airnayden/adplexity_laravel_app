@include('header')

<!-- Customer Index Table -->
<div class="row py-2">
    <table class="table table-bordered data-table">
        <thead>
        <tr>
            <th>
                {{ __('adplexity.text_id') }}
            </th>
            <th>
                {{ __('adplexity.text_filename') }}
            </th>
            <th>
                {{ __('adplexity.text_format') }}
            </th>
            <th>
                {{ __('adplexity.text_url') }}
            </th>
            <th>
                {{ __('adplexity.text_status') }}
            </th>
            <th>
                {{ __('adplexity.text_error') }}
            </th>
            <th>
                {{ __('adplexity.text_created_at') }}
            </th>
            <th>
                {{ __('adplexity.text_updated_at') }}
            </th>
            <th>
                {{ __('adplexity.text_download') }}
            </th>
        </tr>
        </thead>
        <tbody id="downloads-content">
        @forelse($downloads as $download)
            <tr class="download-result-entity">
                <td data-test-id="download-{{ $download->id }}">{{ $download->id }}</td>
                <td>{{ $download->filename }}</td>
                <td>{{ $download->format}}</td>
                <td>{{ $download->url }}</td>
                <td>{{ $download->status }}</td>
                <td>{{ $download->error }}</td>
                <td>{{ $download->created_at }}</td>
                <td>{{ $download->updated_at }}</td>
                <td class="text-center">
                    @if ($download->status == $completeStatusCode)
                        <a href="{{ route('downloads.download_web', ['id' => $download->id]) }}" class="btn btn-success download-entity-download"><i class="fa fa-download"></i></a>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9">{{ __('adplexity.error_no_downloads') }}</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<!-- Footer -->
@include('footer')
