<footer class="bg-[#e6ecf5] pt-12 pb-6 px-6  text-gray-700">
    <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-6 border-b border-gray-200 pb-8">

        <!-- Left: Logo + Address -->
        <div>
            <div class="text-orange-500 font-bold text-xl">
                @php $logo = get_field('footer_logo', 'option'); @endphp
                @if($logo)
                <img src="{{ $logo['url'] }}" alt="Footer Logo" class="max-w-1/2">
                @endif
            </div>
            <div class="text-xs text-gray-500 mt-1 mb-4">{!! get_field('logo_text', 'option') !!}</div>

            <div class="text-sm mb-2 text-[#5B5F7D]">
                {{-- <strong>tmsbuddies GmbH</strong><br>
                Adresse 21, Germany
            </div>
            <div class="mb-2">+49 170 2224609</div>
            <div class="mb-4">info@tmsbuddies.de</div> --}}
            {!! get_field('address_details', 'option') !!}
        </div>
            <!-- Social Icons (Use real icons as needed) -->
            <div class="flex space-x-2 mt-4">
                @php
                $social_links = get_field('social_links', 'option');
                @endphp

                @if ($social_links)
                <div class="flex items-center space-x-3">
                    @foreach ($social_links as $item)
                    @php
                        $logo = $item['social_logo'];
                        $link = $item['social_link'];
                    @endphp

                    @if ($logo && $link)
                        <a href="{{ $link['url'] }}" target="{{ $link['target'] ?? '_self' }}">
                        <img src="{{ $logo['url'] }}" alt="{{ $logo['alt'] ?? 'Social Icon' }}" class="h-10" />
                        </a>
                    @endif
                    @endforeach
                </div>
                @endif

                {{-- <a href="#"><img src="http://localhost/skinhouse/wp-content/themes/skin-house/theme/images/social.png"
                        class="h-10" /></a>
                <a href="#"><img src="http://localhost/skinhouse/wp-content/themes/skin-house/theme/images/social.png"
                        class="h-10" /></a>
                <a href="#"><img src="http://localhost/skinhouse/wp-content/themes/skin-house/theme/images/social.png"
                        class="h-10" /></a>
                <a href="#"><img src="http://localhost/skinhouse/wp-content/themes/skin-house/theme/images/social.png"
                        class="h-10" /></a>
                <a href="#"><img src="http://localhost/skinhouse/wp-content/themes/skin-house/theme/images/social.png"
                        class="h-10" /></a> --}}

            </div>
        </div>

        <!-- Center: Menu -->
        <div>
            <h4 class="font-semibold mb-4">Menu</h4>
            <ul class="space-y-2 text-sm text-[#5B5F7D]">
                {{-- <li><a href="#" class="hover:underline">Menu</a></li>
                <li><a href="#" class="hover:underline">Menu</a></li>
                <li><a href="#" class="hover:underline">Menu</a></li>
            </ul> --}}
            <ul>
            @if (have_rows('menu', 'option'))
                @while (have_rows('menu', 'option')) @php the_row() @endphp
                @php
                    $menu_link = get_sub_field('menu_link');
                @endphp
                @if ($menu_link)
                    <li>
                    <a href="{{ $menu_link['url'] }}" target="{{ $menu_link['target'] }}" class="hover:underline">
                        {{ $menu_link['title'] }}
                    </a>
                    </li>
                @endif
                @endwhile
            @endif
            </ul>

        </div>

        <!-- Right: Webinar -->
        <div>
            @php
                $button_link = get_field('button_link', 'option');
            @endphp
            <h4 class="font-semibold mb-4">{{ get_field('m3_title', 'option') }}</h4>
            <p class="mb-4 text-sm">{{ get_field('m3_tag', 'option') }}</p>
            <a href="{{ $button_link['url'] }}" class="bg-orange-500 text-white py-2 px-4 rounded-full font-medium text-sm hover:bg-orange-600">                
                {{ $button_link['title'] }}
            </a>
        </div>
    </div>

    <!-- Bottom: Legal -->
    <div class="max-w-6xl mx-auto pt-4 text-xs text-gray-500 flex flex-col md:flex-row justify-between items-center">
        <p>{{ get_field('copyright_text', 'option') }}</p>
        <div class="mt-2 md:mt-0 space-x-4">
             @if (have_rows('footer_pages', 'option'))
                @while (have_rows('footer_pages', 'option')) @php the_row() @endphp
                @php
                    $menu_link = get_sub_field('page_links');
                @endphp
                @if ($menu_link)
                    <a href="{{ $menu_link['url'] }}" target="{{ $menu_link['target'] }}" class="hover:underline">
                        {{ $menu_link['title'] }}
                    </a>
                @endif
                @endwhile
            @endif
        </div>
    </div>
</footer>