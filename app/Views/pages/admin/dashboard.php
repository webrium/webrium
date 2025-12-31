@section('content')
<div class="space-y-6">
  <!-- Welcome Section -->
  <div class="bg-gradient-to-r from-primary to-secondary text-white rounded-2xl shadow-xl p-8">
    <h2 class="text-3xl font-bold mb-2">Welcome back, Admin!</h2>
    <p class="text-white/90">Here's what's happening with your store today.</p>
  </div>

  <!-- Statistics Cards -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Total Sales Card -->
    <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-300">
      <div class="card-body">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-base-content/60 font-medium">Total Sales</p>
            <h3 class="text-3xl font-bold mt-2">$24,567</h3>
            <div class="flex items-center gap-1 mt-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
              </svg>
              <span class="text-success text-sm font-medium">+12.5%</span>
              <span class="text-base-content/60 text-xs">vs last month</span>
            </div>
          </div>
          <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
        </div>
      </div>
    </div>

    <!-- Total Orders Card -->
    <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-300">
      <div class="card-body">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-base-content/60 font-medium">Total Orders</p>
            <h3 class="text-3xl font-bold mt-2">1,234</h3>
            <div class="flex items-center gap-1 mt-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
              </svg>
              <span class="text-success text-sm font-medium">+8.3%</span>
              <span class="text-base-content/60 text-xs">vs last month</span>
            </div>
          </div>
          <div class="w-16 h-16 rounded-full bg-secondary/10 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
          </div>
        </div>
      </div>
    </div>

    <!-- Total Customers Card -->
    <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-300">
      <div class="card-body">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-base-content/60 font-medium">Total Customers</p>
            <h3 class="text-3xl font-bold mt-2">892</h3>
            <div class="flex items-center gap-1 mt-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
              </svg>
              <span class="text-success text-sm font-medium">+15.2%</span>
              <span class="text-base-content/60 text-xs">vs last month</span>
            </div>
          </div>
          <div class="w-16 h-16 rounded-full bg-accent/10 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
          </div>
        </div>
      </div>
    </div>

    <!-- Total Products Card -->
    <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-300">
      <div class="card-body">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-base-content/60 font-medium">Total Products</p>
            <h3 class="text-3xl font-bold mt-2">456</h3>
            <div class="flex items-center gap-1 mt-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-info" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14" />
              </svg>
              <span class="text-info text-sm font-medium">+2.1%</span>
              <span class="text-base-content/60 text-xs">vs last month</span>
            </div>
          </div>
          <div class="w-16 h-16 rounded-full bg-info/10 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-info" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Charts and Recent Activity -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Sales Chart -->
    <div class="lg:col-span-2 card bg-base-100 shadow-xl">
      <div class="card-body">
        <h3 class="card-title text-xl">Sales Overview</h3>
        <div class="h-80 flex items-center justify-center bg-base-200 rounded-lg mt-4">
          <p class="text-base-content/60">Chart will be rendered here</p>
        </div>
      </div>
    </div>

    <!-- Recent Orders -->
    <div class="card bg-base-100 shadow-xl">
      <div class="card-body">
        <h3 class="card-title text-xl mb-4">Recent Orders</h3>
        <div class="space-y-4">
          <!-- Order Item -->
          <div class="flex items-center gap-3 p-3 bg-base-200 rounded-lg hover:bg-base-300 transition-colors cursor-pointer">
            <div class="avatar placeholder">
              <div class="bg-primary text-primary-content rounded-full w-10">
                <span class="text-xs">#1234</span>
              </div>
            </div>
            <div class="flex-1 min-w-0">
              <p class="font-medium truncate">John Doe</p>
              <p class="text-sm text-base-content/60">$249.99</p>
            </div>
            <div class="badge badge-success badge-sm">Paid</div>
          </div>

          <!-- Order Item -->
          <div class="flex items-center gap-3 p-3 bg-base-200 rounded-lg hover:bg-base-300 transition-colors cursor-pointer">
            <div class="avatar placeholder">
              <div class="bg-secondary text-secondary-content rounded-full w-10">
                <span class="text-xs">#1233</span>
              </div>
            </div>
            <div class="flex-1 min-w-0">
              <p class="font-medium truncate">Jane Smith</p>
              <p class="text-sm text-base-content/60">$189.50</p>
            </div>
            <div class="badge badge-warning badge-sm">Pending</div>
          </div>

          <!-- Order Item -->
          <div class="flex items-center gap-3 p-3 bg-base-200 rounded-lg hover:bg-base-300 transition-colors cursor-pointer">
            <div class="avatar placeholder">
              <div class="bg-accent text-accent-content rounded-full w-10">
                <span class="text-xs">#1232</span>
              </div>
            </div>
            <div class="flex-1 min-w-0">
              <p class="font-medium truncate">Mike Johnson</p>
              <p class="text-sm text-base-content/60">$399.00</p>
            </div>
            <div class="badge badge-info badge-sm">Shipped</div>
          </div>

          <!-- Order Item -->
          <div class="flex items-center gap-3 p-3 bg-base-200 rounded-lg hover:bg-base-300 transition-colors cursor-pointer">
            <div class="avatar placeholder">
              <div class="bg-info text-info-content rounded-full w-10">
                <span class="text-xs">#1231</span>
              </div>
            </div>
            <div class="flex-1 min-w-0">
              <p class="font-medium truncate">Sarah Williams</p>
              <p class="text-sm text-base-content/60">$149.99</p>
            </div>
            <div class="badge badge-success badge-sm">Delivered</div>
          </div>
        </div>

        <button class="btn btn-outline btn-sm mt-4 w-full">View All Orders</button>
      </div>
    </div>
  </div>

  <!-- Top Products & Low Stock -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Top Products -->
    <div class="card bg-base-100 shadow-xl">
      <div class="card-body">
        <h3 class="card-title text-xl mb-4">Top Selling Products</h3>
        <div class="overflow-x-auto">
          <table class="table table-zebra">
            <thead>
              <tr>
                <th>Product</th>
                <th>Sales</th>
                <th>Revenue</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <div class="flex items-center gap-3">
                    <div class="avatar">
                      <div class="mask mask-squircle w-12 h-12 bg-base-300">
                        <img src="https://via.placeholder.com/100" alt="Product" />
                      </div>
                    </div>
                    <div>
                      <div class="font-bold">Wireless Headphones</div>
                      <div class="text-sm opacity-50">Electronics</div>
                    </div>
                  </div>
                </td>
                <td>
                  <span class="badge badge-primary">245</span>
                </td>
                <td>
                  <span class="font-semibold">$12,250</span>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="flex items-center gap-3">
                    <div class="avatar">
                      <div class="mask mask-squircle w-12 h-12 bg-base-300">
                        <img src="https://via.placeholder.com/100" alt="Product" />
                      </div>
                    </div>
                    <div>
                      <div class="font-bold">Smart Watch</div>
                      <div class="text-sm opacity-50">Accessories</div>
                    </div>
                  </div>
                </td>
                <td>
                  <span class="badge badge-secondary">189</span>
                </td>
                <td>
                  <span class="font-semibold">$18,900</span>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="flex items-center gap-3">
                    <div class="avatar">
                      <div class="mask mask-squircle w-12 h-12 bg-base-300">
                        <img src="https://via.placeholder.com/100" alt="Product" />
                      </div>
                    </div>
                    <div>
                      <div class="font-bold">Laptop Stand</div>
                      <div class="text-sm opacity-50">Office</div>
                    </div>
                  </div>
                </td>
                <td>
                  <span class="badge badge-accent">156</span>
                </td>
                <td>
                  <span class="font-semibold">$4,680</span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Low Stock Alert -->
    <div class="card bg-base-100 shadow-xl">
      <div class="card-body">
        <h3 class="card-title text-xl mb-4">
          Low Stock Alert
          <div class="badge badge-error">3</div>
        </h3>
        <div class="space-y-3">
          <!-- Stock Alert Item -->
          <div class="alert alert-warning shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <div class="w-full">
              <h3 class="font-bold">USB Cable</h3>
              <div class="text-xs">Only 5 units left in stock</div>
            </div>
          </div>

          <!-- Stock Alert Item -->
          <div class="alert alert-warning shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <div class="w-full">
              <h3 class="font-bold">Phone Case</h3>
              <div class="text-xs">Only 8 units left in stock</div>
            </div>
          </div>

          <!-- Stock Alert Item -->
          <div class="alert alert-error shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div class="w-full">
              <h3 class="font-bold">Screen Protector</h3>
              <div class="text-xs">Out of stock - Reorder immediately</div>
            </div>
          </div>
        </div>
        <button class="btn btn-error btn-sm mt-4 w-full">Manage Inventory</button>
      </div>
    </div>
  </div>
</div>
@endsection