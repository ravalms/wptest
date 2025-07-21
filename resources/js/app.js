import.meta.glob([
  '../images/**',
  '../fonts/**',
]);

// counter
document.addEventListener('DOMContentLoaded', function () {
    let secondsSpan = document.getElementById('seconds');
    let seconds = parseInt(secondsSpan.innerText);

    setInterval(() => {
      seconds = (seconds + 1) % 60;
      secondsSpan.innerText = seconds.toString().padStart(2, '0');
    }, 1000);
  });

  // change value on click


// document.addEventListener('DOMContentLoaded', () => {
//   const totalEl = document.getElementById('total-price');
//   let total = 0;
//   const addedPrices = new Set();

//   // Get all price elements and bind click to next sibling (plus icon)
//   const priceEls = document.querySelectorAll('.price-value');

//   priceEls.forEach((priceEl, index) => {
//     const img = priceEl.nextElementSibling;

//     if (!img || !img.classList.contains('add-to-selection')) return;

//     img.addEventListener('click', () => {
//       const raw = priceEl.dataset.price || priceEl.textContent.trim();
//       const price = parseFloat(raw.replace(',', '.'));

//       if (addedPrices.has(index)) {
//         // Remove from total and revert styles
//         total -= price;
//         addedPrices.delete(index);
//         priceEl.innerHTML = price.toFixed(2).replace('.', ',') + ' €';
//         priceEl.classList.remove('text-red-500', 'line-through');
//       } else {
//         // Add to total and apply styles
//         total += price;
//         addedPrices.add(index);
//         priceEl.innerHTML = `<del>${price.toFixed(2).replace('.', ',')} €</del>`;
//         priceEl.classList.add('text-red-500', 'line-through');
//       }

//       // Update total
//       totalEl.textContent = total.toFixed(2).replace('.', ',') + ' €';
//     });
//   });
// });

document.addEventListener('DOMContentLoaded', () => {
  const totalPriceEl = document.getElementById('total-price');
  const selectedItemsContainer = document.getElementById('selected-items');
  const addedPrices = new Set();

  // Step 1: Extract initial product price
  let basePrice = 0;
  const initialHTML = totalPriceEl.innerHTML;
  const match = initialHTML.match(/[\d,.]+/); // Find number
  if (match) {
    basePrice = parseFloat(match[0].replace(',', '.'));
  }

  let dynamicTotal = 0;

  const priceEls = document.querySelectorAll('.price-value');

  priceEls.forEach((priceEl, index) => {
    const img = priceEl.nextElementSibling;

    if (!img || !img.classList.contains('cursor-pointer')) return;

    img.addEventListener('click', () => {
      const raw = priceEl.dataset.price || priceEl.textContent.trim();
      const price = parseFloat(raw.replace(',', '.'));
      
      // const itemName = priceEl.parentElement?.previousElementSibling?.querySelector('.addon-title')?.textContent?.trim() || `Item ${index + 1}`;
      const itemName = priceEl.parentElement?.previousElementSibling?.querySelector('.addon-title')?.dataset.title?.trim() || `Item ${index + 1}`;

      const itemId = `selected-item-${index}`;

      if (addedPrices.has(index)) {
        // Remove
        dynamicTotal -= price;
        addedPrices.delete(index);

        // Reset price display
        priceEl.innerHTML = raw;
        priceEl.classList.remove('line-through', 'text-red-500');

         // Reset to plus icon
         img.src = 'http://localhost/demosite/wp-content/themes/testw/public/build/images/plus.png';


        const label = document.getElementById(itemId);
        if (label) label.remove();
      } else {
        // Add
        dynamicTotal += price;
        addedPrices.add(index);

        priceEl.innerHTML = `<del>${raw}</del>`;
        priceEl.classList.add('line-through', 'text-red-500');

         // Swap to minus icon
        img.src = 'http://localhost/demosite/wp-content/themes/testw/public/build/images/minus.png';

        // Show added item
        const label = document.createElement('label');
        label.id = itemId;
        label.className = "flex items-center gap-x-4";

        label.innerHTML = `
          <span class="flex gap-2">
            <svg class="w-5 h-5 text-black p-1 rounded bg-[#e6eaff]" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd"
                d="M16.707 5.293a1 1 0 010 1.414l-8.414 8.414a1 1 0 01-1.414 0L3.293 11.12a1 1 0 111.414-1.414L8 13l7.293-7.293a1 1 0 011.414 0z"
                clip-rule="evenodd"></path>
            </svg>
            <span>${itemName}</span>
          </span>
          <span><strong>${price.toFixed(2).replace('.', ',')} €</strong></span>
        `;

        selectedItemsContainer.appendChild(label);
      }

      // Step 3: Update total
      const rawTotal = (basePrice + dynamicTotal).toFixed(2); // For WooCommerce (dot format)
      const displayTotal = rawTotal.replace('.', ','); // For UI

      totalPriceEl.innerHTML = displayTotal + ' €';

      // Set to hidden input for cart
      const hiddenInput = document.getElementById('custom_total_price');
      if (hiddenInput) hiddenInput.value = rawTotal;
    });
  });
});

