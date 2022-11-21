
{foreach $categories as $category}
    <a href="?page=category&id={$category['id']}"> <button class="button-3"><h2> {$category['name']} </h2></a></button> <div class="space"></div>
{/foreach}
