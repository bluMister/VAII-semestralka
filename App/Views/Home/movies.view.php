
<div class="container3">
    <div class="news-cards">
                <?php

                /** @var Prispevky[] $data */

                use App\Models\Prispevky;

                ?>
                <div class="row mb-3 p-3">
                    <?php
                    foreach ($data as $prispevky) {
                        ?>
                        <h3 class="mb-0"><?= $prispevky->getNazov() ?></h3>
                        <?php
                    }
                    ?>
                </div>
        <div class="card">
            <img src="/public/images/thumbnail.jpg" alt="News 1">
            <h2>News Title 1</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus dignissim fermentum...</p>
            <a href="#" class="read-more">Read More</a>
        </div>
        <div class="card">
            <img src="/public/images/thumbnail.jpg" alt="News 2">
            <h2>News Title 2</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus dignissim fermentum...</p>
            <a href="#" class="read-more">Read More</a>
        </div>
        <div class="card">
            <img src="/public/images/thumbnail.jpg" alt="News 2">
            <h2>News Title 2</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus dignissim fermentum...</p>
            <a href="#" class="read-more">Read More</a>
        </div>
        <div class="card">
            <img src="/public/images/thumbnail.jpg" alt="News 2">
            <h2>News Title 2</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus dignissim fermentum...</p>
            <a href="#" class="read-more">Read More</a>
        </div>
        <div class="card">
            <img src="/public/images/thumbnail.jpg" alt="News 2">
            <h2>News Title 2</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus dignissim fermentum...</p>
            <a href="#" class="read-more">Read More</a>
        </div>
        <!-- Add more cards as needed -->
    </div>
</div>


