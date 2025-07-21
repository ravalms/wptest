@php
    global $product;
    $product = wc_get_product(get_the_ID());

    // get other products
    $current_id = $product->get_id();

    $other_products = new WP_Query([
        'post_type'      => 'product',
        'posts_per_page' => 10,
        'post__not_in'   => [$current_id],
        'post_status'    => 'publish',
    ]);
    $counter = 0;

@endphp
<section class="w-full bg-white px-6 py-16">
    <div class="max-w-6xl mx-auto flex flex-col lg:flex-row items-center gap-12">
        <!-- Product Image -->
        <div class="w-full lg:w-1/2 flex justify-center">
            <img src="{{ get_the_post_thumbnail_url(get_the_ID(), 'large') }}" alt="{{ get_the_title() }}" class="max-h-[400px] w-auto">
        </div>

        <!-- Product Info -->
        <div class="w-full lg:w-1/2">
            <div class="flex justify-items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">{{ get_the_title() }}</h2>
                    <div class="flex items-center gap-2 mt-2 text-sm">
                        <span class="font-semibold text-black-500">5,0</span>
                        <div class="flex text-yellow-400">
                            ⭐ ⭐ ⭐ ⭐ ⭐
                            <!-- repeat 4 more stars -->
                        </div>
                        <span class="text-gray-500">(120)</span>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-xl font-bold text-gray-900">  ab {!! $product->get_price_html() !!}</p>
                </div>
            </div>

            <!-- Description -->
            <p class="mt-4 text-gray-700  leading-relaxed">{!! get_the_content() !!}</p>

            <!-- Mehr Erfahren -->
            <div class="text-right">
                <a href="#"
                    class="mt-2 inline-block  font-semibold underline text-gray-900 hover:text-orange-600">
                    Mehr erfahren
                </a>
            </div>

            <!-- Features -->
            <ul class="mt-6 space-y-3  text-gray-800">
            @if (have_rows('p_types'))
                @while (have_rows('p_types')) @php(the_row())
                <li class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-black p-1 rounded bg-[#e6eaff]" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M16.707 5.293a1 1 0 010 1.414l-8.414 8.414a1 1 0 01-1.414 0L3.293 11.12a1 1 0 111.414-1.414L8 13l7.293-7.293a1 1 0 011.414 0z"
                        clip-rule="evenodd" />
                    </svg>
                    {{ get_sub_field('type_text') }}
                </li>
                @endwhile
            @endif
            </ul>
        </div>
    </div>

    <div class="space-y-3 max-w-6xl mx-auto mt-12 mb-4">
       
    {{-- dynamic module  --}}
        @if (have_rows('modules'))
        @php($index = 0)
        @while (have_rows('modules'))
            @php(the_row())
            @php($index++)
            @php($moduleName = get_sub_field('m_name'))

                <div x-data="{ open: false }" class="rounded-xl overflow-hidden bg-[#eef0ff] mb-4">
                    <button @click="open = !open" class="w-full px-4 py-3 flex justify-between items-center text-left">
                        <span class=" font-medium text-gray-800">{{ $moduleName }}</span>
                        <span class="text-xl font-bold text-gray-600">
                            <span x-show="!open">+</span>
                            <span x-show="open">−</span>
                        </span>
                    </button>

                    <div x-show="open" x-collapse class="p-4  text-gray-700 bg-white border-x border-b border-gray-300 rounded-b-[12px] space-y-2">
                        @if (have_rows('m_items'))
                            @while (have_rows('m_items'))
                                @php(the_row())
                                @php($title = get_sub_field('title'))
                                @php($price = get_sub_field('price'))

                                <div class="flex items-center justify-between">
                                    <div class="flex addon-item items-center gap-2">
                                        <svg class="w-5 h-5 text-black p-1 rounded bg-[#e6eaff]" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8.414 8.414a1 1 0 01-1.414 0L3.293 11.12a1 1 0 111.414-1.414L8 13l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        {{-- <span class="addon-title">{{ $title }}</span> --}}
                                        <span class="addon-title" data-title="{{ $moduleName}}: {{ $title }}">{{ $title }}</span>

                                    </div>
                                    @if (is_numeric($price))
                                        <div class="flex items-center gap-1  font-semibold text-gray-900">
                                        <span class="price-value" data-price="{{ number_format($price, 2, ',', '.') }} €">{{ number_format($price, 2, ',', '.') }} €</span>
                                        <img src="@asset('images/plus.png')" class="h-4 w-4 cursor-pointer add-to-selection" alt="plus" />
                                        </div>

                                    @endif
                                </div>
                            @endwhile
                        @endif
                    </div>
                </div>
            @endwhile
        @endif
        {{-- end modules --}}

        <div class="pt-4 text-gray-700 bg-white space-y-2">
            <div id="selected-items" class="space-y-2 pt-4 text-gray-700 bg-white"></div>
        </div>

        {{--  --}}
        <div class="text-black font-bold mt-4 flex gap-2 items-center"><img
                src="@asset('images/msg.png')"
                class="h-4 w-4" />Zusätzliche Optionen anpassen
        </div>
    </div>
</section>
{{-- price section --}}
<section class="w-full bg-[#f5f6fa] px-6 py-10">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row md:items-center md:justify-between gap-6">
        <!-- Price Info -->
        <div>
            <p class="text-xl md:text-2xl font-semibold text-gray-900">
                Gesamtprice: <span class="ml-2" id="total-price">{!! $product->get_price_html() !!}</span>
            </p>
            <p class="text-sm text-gray-700 mt-1">
                Oder <span class="font-bold">37,00 €</span> mtl. in <span class="font-bold">6</span> Raten.
                <a href="#" class="ml-2 underline font-semibold text-gray-800 hover:text-orange-600">Zum
                    Ratenrechner</a>
            </p>
        </div>
        
        <!-- Button -->
        <div>
            <form class="cart" action="{{ esc_url(wc_get_cart_url()) }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="add-to-cart" value="{{ get_the_ID() }}" />
                <button type="submit"
                    class="bg-orange-500 hover:bg-orange-600 text-white  font-semibold px-6 py-3 rounded-full cursor-pointer">
                    Jetzt bestellen <span class="ml-2">→</span>
                </button>
                <input type="hidden" name="custom_total_price" id="custom_total_price" value="{!! $product->get_price() !!}">

            </form>
        </div>

    </div>
</section>
{{-- package details section --}}
<section class="w-full bg-white px-6 py-8">
  <div class="max-w-6xl mx-auto">

    @if(have_rows('packages'))
      @while(have_rows('packages')) @php(the_row())
        @php($package_name = get_sub_field('package_name'))

        <div class="mt-20"> {{-- ← Space between packages --}}
          <h2 class="text-2xl font-bold text-gray-900 mb-10">{{ $package_name }}</h2>

          @if(have_rows('package_items'))
            @while(have_rows('package_items')) @php(the_row())
              @php($item_title = get_sub_field('item_title'))
              @php($item_image = get_sub_field('item_image'))
              @php($item_description = get_sub_field('item_description'))

              <div class="grid grid-cols-1 md:grid-cols-[40%_60%] gap-8 mb-10 items-start">
                <!-- Image -->
                <div>
                  @if($item_image)
                    <img src="{{ $item_image['url'] }}" alt="{{ $item_image['alt'] ?? $item_title }}" class="w-full h-40 object-cover rounded-2xl bg-[#f5f6fa]" />
                  @else
                    <div class="h-40 rounded-2xl bg-[#f5f6fa]"></div>
                  @endif
                </div>

                <!-- Content -->
                <div>
                  <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ $item_title }}</h4>
                  <p class="text-gray-700  leading-relaxed">{{ $item_description }}</p>
                  <div class="text-right">
                    <a href="#" class="mt-2 inline-block  font-semibold underline text-gray-900 hover:text-orange-600">
                      Mehr erfahren
                    </a>
                  </div>
                </div>
              </div>

            @endwhile
          @endif
        </div>

      @endwhile
    @endif
  </div>
</section>
{{-- related product section --}}
<section class="bg-[#f5f6fa] px-6 py-16">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Das könnte dich auch interessieren</h2>
                <p class="mt-2 text-gray-700  max-w-2xl">
                    Möchtest du es erstmal ausprobieren, ein spezielles Gebiet perfektionieren oder bist du einfach auf
                    der Suche nach einem umfassenden Gesamtpaket?
                </p>
            </div>
            <a href="#"
                class="mt-4 md:mt-0 inline-flex items-center px-5 py-2 border border-gray-800 rounded-full  font-semibold hover:bg-gray-900 hover:text-white transition">
                Alle Angebote entdecken
                <span class="ml-2">→</span>
            </a>
        </div>

        <!-- Package Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-[800px] mx-auto">
           
        @if ($other_products->have_posts())
            @while ($other_products->have_posts())
                @php($other_products->the_post())
                @php($counter++)

                
                @if ($counter % 2 === 0)
                    {{-- Even: White background with black text --}}
                    <div class="bg-white max-w-[350px] text-gray-900 rounded-3xl p-6 shadow-sm">
                        <!-- Title & Rating -->
                        {{-- <h3 class="text-xl font-bold mb-2">Rundum-Sorglos-Paket</h3> --}}
                        <h3 class="text-xl font-bold mb-2">{{ get_the_title() }}</h3>

                        <p class="text-sm mb-4">
                            5.0 <span class="text-gray-500">⭐ ⭐ ⭐ ⭐ ⭐ (120)</span>
                        </p>
                        <div class="mb-2 mt-12 mb-12">
                            <img src="{{ get_the_post_thumbnail_url(get_the_ID(), 'medium') ?: wc_placeholder_img_src() }}" alt="Basis Paket" class="max-h-[400px] w-auto">
                        </div>
                        <p class=" mb-4">
                        {{ \Illuminate\Support\Str::words(strip_tags(get_the_content()), 12, '...') }}
                        </p>
                        <!-- Price -->
                        {{-- <p class="text-3xl text-center font-bold mb-4">ab 219,00€</p> --}}
                        <p class="text-4xl text-center font-bold mb-4">ab {!! $product->get_price_html() !!}</p>

                        <a href="{{ get_permalink() }}">
                        <button
                            class="w-full bg-orange-500 hover:bg-orange-600 text-white py-2 rounded-full  font-semibold mb-6 cursor-pointer">
                            Alle Details
                        </button>
                        </a>
                        <!-- Features -->
                        <ul class=" space-y-2">
                            @if (have_rows('p_types'))
                                @while (have_rows('p_types')) @php(the_row())
                                <li class="flex gap-2"><svg class="w-5 h-5 text-black p-1 rounded bg-[#e6eaff]" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8.414 8.414a1 1 0 01-1.414 0L3.293 11.12a1 1 0 111.414-1.414L8 13l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                    {{ get_sub_field('type_text') }}
                                </li>
                                @endwhile
                            @endif
                        </ul>
                        
                    </div>
                @else
                    {{-- card 1 --}}
                    <div class="bg-gray-900 max-w-[350px] text-white rounded-3xl p-6 relative">
                        <!-- Badge -->
                        
                        <div
                            class="absolute top-0 right-0 px-3 py-1 text-lg font-light bg-[#FFBAFE] text-[#190f23] rounded-tr-2xl rounded-bl-2xl">
                            Bestseller
                        </div>

                        <!-- Title & Rating -->
                        <h3 class="text-xl font-bold mb-2">{{ get_the_title() }}</h3>
                        <p class="text-sm mb-2">
                            5.0 <span class="text-gray-300">⭐ ⭐ ⭐ ⭐ ⭐ (100)</span>
                        </p>
                        <!-- Image -->
                        <div class="mb-2 mt-12 mb-12">
                            <img src="{{ get_the_post_thumbnail_url(get_the_ID(), 'medium') ?: wc_placeholder_img_src() }}" alt="Basis Paket" class="max-h-[400px] w-auto">
                        </div>
                        <!-- Description -->
                        <p class=" mb-4">
                        {{ \Illuminate\Support\Str::words(strip_tags(get_the_content()), 12, '...') }}
                        </p>
                        <!-- Price -->
                        <p class="text-4xl text-center font-bold mb-4">ab {!! $product->get_price_html() !!}</p>
                        <!-- Button -->
                    <a href="{{ get_permalink() }}">
                        <button
                            class="w-full bg-orange-500 hover:bg-orange-600 text-white py-2 rounded-full  font-semibold mb-6 cursor-pointer">
                            Alle Details
                        </button>
                        </a>

                        <!-- Features -->
                        <ul class=" space-y-2">
                            @if (have_rows('p_types'))
                                @while (have_rows('p_types')) @php(the_row())
                                <li class="flex gap-2"><svg class="w-5 h-5 text-white p-1 rounded bg-[#383b43]" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8.414 8.414a1 1 0 01-1.414 0L3.293 11.12a1 1 0 111.414-1.414L8 13l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    {{ get_sub_field('type_text') }}
                                </li>
                                @endwhile
                            @endif
                        </ul>
                    </div>

                @endif
            @endwhile
            @php(wp_reset_postdata())
        @endif
            
        </div>
    </div>
</section>
