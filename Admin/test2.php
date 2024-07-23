<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banner and Product Slider</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .slider-container {
            width: 100%;
            overflow: hidden;
            margin: 20px 0;
        }

        /* Banner Slider */
        .banner-slider {
            position: relative;
            height: 500px;
        }

        .banner-slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
            height: 100%;
        }

        .banner-slide {
            min-width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .banner-content {
            background: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }

        /* Product Slider */
        .product-slider {
            position: relative;
            display: flex;
            align-items: center;
        }

        .product-slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
            overflow: hidden;
            width: calc(100% - 60px);
        }

        .product-slide {
            min-width: 25%;
            padding: 20px;
            box-sizing: border-box;
            text-align: center;
        }

        .product-slide img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        .product-prev, .product-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 10px;
            z-index: 1;
        }

        .product-prev {
            left: 10px;
        }

        .product-next {
            right: 10px;
            background-color: pink;
        }
    </style>
</head>
<body>
    <!-- Banner Slider -->
    <div class="slider-container">
        <div class="banner-slider">
            <div class="banner-slides">
                <div class="banner-slide" style="background-image: url('images/big/card-1.png');">
                    <div class="banner-content">
                        <h1>Banner 1</h1>
                    </div>
                </div>
                <div class="banner-slide" style="background-image: url('images/big/card-1.png');">
                    <div class="banner-content">
                        <h1>Banner 2</h1>
                    </div>
                </div>
                <div class="banner-slide" style="background-image: url('images/big/card-1.png');">
                    <div class="banner-content">
                        <h1>Banner 3</h1>
                    </div>
                </div>
                <div class="banner-slide" style="background-image: url('images/big/card-1.png');">
                    <div class="banner-content">
                        <h1>Banner 4</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Slider -->
    <div class="slider-container">
        <div class="product-slider">
            <button class="product-prev">&#10094;</button>
            <div class="product-slides">
                <div class="product-slide">
                    <img src="images/big/card-1.png" alt="Product 1">
                    <p>Product 1</p>
                </div>
                <div class="product-slide">
                    <img src="images/big/card-1.png" alt="Product 2">
                    <p>Product 2</p>
                </div>
                <div class="product-slide">
                    <img src="images/big/card-1.png" alt="Product 3">
                    <p>Product 3</p>
                </div>
                <div class="product-slide">
                    <img src="images/big/card-1.png" alt="Product 4">
                    <p>Product 4</p>
                </div>
                <div class="product-slide">
                    <img src="images/big/card-1.png" alt="Product 5">
                    <p>Product 5</p>
                </div>
                <div class="product-slide">
                    <img src="images/big/card-1.png" alt="Product 6">
                    <p>Product 6</p>
                </div>
                <div class="product-slide">
                    <img src="images/big/card-1.png" alt="Product 7">
                    <p>Product 7</p>
                </div>
                <div class="product-slide">
                    <img src="images/big/card-1.png" alt="Product 8">
                    <p>Product 8</p>
                </div>
            </div>
            <button class="product-next">&#10095;</button>
        </div>
    </div>

    <script>
        // Banner Slider
        let bannerIndex = 0;
        const bannerSlides = document.querySelectorAll('.banner-slide');
        const totalBannerSlides = bannerSlides.length;

        function showBannerSlide(n) {
            if (n >= totalBannerSlides) bannerIndex = 0;
            else if (n < 0) bannerIndex = totalBannerSlides - 1;
            else bannerIndex = n;
            const offset = -bannerIndex * 100;
            document.querySelector('.banner-slides').style.transform = `translateX(${offset}%)`;
        }

        function nextBannerSlide() {
            showBannerSlide(bannerIndex + 1);
        }

        if (totalBannerSlides > 1) {
            setInterval(nextBannerSlide, 3000); // Change banner slide every 3 seconds only if more than one slide
        }

        // Product Slider
        let productIndex = 0;
        const productSlides = document.querySelectorAll('.product-slide');
        const totalProductSlides = productSlides.length;
        const slidesToShow = 4;

        function showProductSlide(n) {
            if (n >= totalProductSlides - slidesToShow) productIndex = 0;
            else if (n < 0) productIndex = totalProductSlides - slidesToShow;
            else productIndex = n;
            const offset = -productIndex * (100 / slidesToShow);
            document.querySelector('.product-slides').style.transform = `translateX(${offset}%)`;
        }

        document.querySelector('.product-next').addEventListener('click', () => {
            showProductSlide(productIndex + 1);
        });

        document.querySelector('.product-prev').addEventListener('click', () => {
            showProductSlide(productIndex - 1);
        });

        // Initialize the product slider
        showProductSlide(0);

    </script>
</body>
</html>
