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
                 {{ __('adplexity.text_extension') }}
            </th>
            <th>
                {{ __('adplexity.text_url') }}
            </th>
            <th>
                {{ __('adplexity.text_status') }}
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

        </tbody>
    </table>
</div>

<!-- Footer -->
@include('footer')
