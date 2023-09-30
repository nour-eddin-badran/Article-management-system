<x-modal id="add-article-modal" title="{{__('common.add') . ' ' . __('common.article')}}" uri="/articles" dataTableId="articles-table">
    <x-slot name="body">
        @include('pages.article.form')
    </x-slot>

    <x-slot name="metaJS">
        <script>
            payload_add_article_modal = {
                title: "article-title",
                description: "article-description",
                cover: "article-cover"
            }
            required_add_article_modal = {
                title: "article-title",
                description: "article-description",
                cover: "article-cover"
            }
        </script>
    </x-slot>
</x-modal>