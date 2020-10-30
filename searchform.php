<form action="<?= home_url( '/' ); ?>"
      method="get">

    <div class="input-group">
        <input class="form-control"
               type="search"
               name="s"
               placeholder="Search..."
               minlength="3"
               maxlength="80"
               aria-label="Search"
               required
               value="<?php echo get_search_query() ?>">

        <div class="input-group-append">
            <button class="input-group-text"
                    type="submit"
                    aria-label="Submit">
            </button>
        </div>
    </div>
</form>
