<header class="bg-white shadow">
  <section class="w-full">
    {{-- <div class="container mx-auto w-full px-6 py-4 flex items-center justify-between"> --}}
      <div class="max-w-6xl mx-auto py-8 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
      <!-- Logo -->
      <div class="flex items-center space-x-2">
        @php
          $custom_logo_id = get_theme_mod('custom_logo');
          $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
        @endphp

        @if ($logo)
          <a href="{{ home_url('/') }}">
            <img src="{{ $logo[0] }}" alt="{{ get_bloginfo('name', 'display') }}" class="h-8 w-auto">
          </a>
        @else
          <a href="{{ home_url('/') }}" class="text-xl font-bold">
            {{ get_bloginfo('name') }}
          </a>
        @endif
      </div>

      <!-- Navigation -->
      <nav class="hidden md:flex space-x-6 text-gray-900 font-medium">
        @if (has_nav_menu('primary_navigation'))
          {!! wp_nav_menu([
              'theme_location' => 'primary_navigation',
              'menu_class' => 'hidden md:flex space-x-6 text-gray-900 font-medium',
              'container' => false,
              'echo' => false,
          ]) !!}
        @endif
      </nav>

      <!-- Right Side Buttons -->
      <div class="flex items-center space-x-4">
        <!-- Anmelden (Login/Register) -->
        <a href="{{ get_permalink(get_option('woocommerce_myaccount_page_id')) }}" 
           class="px-4 py-2 border border-gray-900 font-semibold rounded-full hover:bg-gray-100">
          Anmelden
        </a>

        <!-- Cart Icon -->
        <a href="{{ wc_get_cart_url() }}">
          <img src="@asset('images/minicart.png')" class="h-8 w-auto">
        </a>
      </div>
    </div>

    <!-- Countdown Bar -->
    <div class="bg-[#EAEFF7] text-center py-2 w-full">
      <span class="text-gray-800 font-medium">TMS 2025 <span class="text-sm">in:</span></span>
      <span class="text-[#5A4FF3] font-bold text-lg mx-1">5</span>
      <span class="text-gray-500 text-sm">Tage</span>
      <span class="text-[#5A4FF3] font-bold text-lg mx-1">13</span>
      <span class="text-gray-500 text-sm">St.</span>
      <span class="text-[#5A4FF3] font-bold text-lg mx-1">23</span>
      <span class="text-gray-500 text-sm">Min.</span>
      <span class="text-[#5A4FF3] font-bold text-lg mx-1" id="seconds">11</span>
      <span class="text-gray-500 text-sm">Sek.</span>
    </div>
  </section>
</header>
