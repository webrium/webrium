@section('content')
<div class="space-y-6">
  <!-- Page Header -->
  <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
      <h2 class="text-2xl font-bold text-base-content">Categories</h2>
      <p class="text-base-content/60 mt-1">Manage your product and post categories</p>
    </div>
    <a href="/admin/categories/create" class="btn btn-primary gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
      </svg>
      Add New Category
    </a>
  </div>

  <!-- Statistics Cards -->
  <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <div class="stats shadow bg-base-100">
      <div class="stat">
        <div class="stat-figure text-primary">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
          </svg>
        </div>
        <div class="stat-title">Total Categories</div>
        <div class="stat-value text-primary">@{{ $stats['total'] ?? 0 }}</div>
      </div>
    </div>

    <div class="stats shadow bg-base-100">
      <div class="stat">
        <div class="stat-figure text-success">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
        <div class="stat-title">Active</div>
        <div class="stat-value text-success">@{{ $stats['active'] ?? 0 }}</div>
      </div>
    </div>

    <div class="stats shadow bg-base-100">
      <div class="stat">
        <div class="stat-figure text-warning">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
        <div class="stat-title">Inactive</div>
        <div class="stat-value text-warning">@{{ $stats['inactive'] ?? 0 }}</div>
      </div>
    </div>

    <div class="stats shadow bg-base-100">
      <div class="stat">
        <div class="stat-figure text-info">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
          </svg>
        </div>
        <div class="stat-title">Root Categories</div>
        <div class="stat-value text-info">@{{ $stats['root'] ?? 0 }}</div>
      </div>
    </div>
  </div>

  <!-- Filters and Search -->
  <div class="card bg-base-100 shadow-xl">
    <div class="card-body">
      <div class="flex flex-col md:flex-row gap-4">
        <!-- Search -->
        <div class="form-control flex-1">
          <div class="input-group">
            <input 
              type="text" 
              placeholder="Search categories..." 
              class="input input-bordered w-full"
              z-model="searchQuery"
              @keyup.enter="searchCategories"
            />
            <button class="btn btn-square" @click="searchCategories">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </button>
          </div>
        </div>

        <!-- Status Filter -->
        <div class="form-control w-full md:w-48">
          <select class="select select-bordered" z-model="statusFilter" @change="filterCategories">
            <option value="">All Status</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
        </div>

        <!-- Parent Filter -->
        <div class="form-control w-full md:w-48">
          <select class="select select-bordered" z-model="parentFilter" @change="filterCategories">
            <option value="">All Categories</option>
            <option value="root">Root Categories</option>
            <option value="child">Sub Categories</option>
          </select>
        </div>

        <!-- Sort -->
        <div class="form-control w-full md:w-48">
          <select class="select select-bordered" z-model="sortBy" @change="sortCategories">
            <option value="order">Order</option>
            <option value="name">Name</option>
            <option value="created_at">Date Created</option>
            <option value="updated_at">Last Updated</option>
          </select>
        </div>
      </div>
    </div>
  </div>

  <!-- Categories Table -->
  <div class="card bg-base-100 shadow-xl">
    <div class="card-body">
      <div class="overflow-x-auto">
        <table class="table table-zebra w-full">
          <thead>
            <tr>
              <th>
                <label>
                  <input type="checkbox" class="checkbox" @change="toggleSelectAll" />
                </label>
              </th>
              <th>Name</th>
              <th>Slug</th>
              <th>Parent</th>
              <th>Status</th>
              <th>Order</th>
              <th>Products</th>
              <th>Created</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr z-for="category in filteredCategories" :key="category.id">
              <th>
                <label>
                  <input 
                    type="checkbox" 
                    class="checkbox" 
                    :value="category.id"
                    z-model="selectedIds"
                  />
                </label>
              </th>
              <td>
                <div class="flex items-center gap-3">
                  <div z-if="category.image" class="avatar">
                    <div class="mask mask-squircle w-12 h-12">
                      <img :src="category.image" :alt="category.name" />
                    </div>
                  </div>
                  <div z-else class="avatar placeholder">
                    <div class="bg-neutral text-neutral-content mask mask-squircle w-12">
                      <span class="text-xl">{{ category.name.charAt(0).toUpperCase() }}</span>
                    </div>
                  </div>
                  <div>
                    <div class="font-bold">{{ category.name }}</div>
                    <div class="text-sm opacity-50" z-if="category.description">
                      {{ category.description.substring(0, 50) }}{{ category.description.length > 50 ? '...' : '' }}
                    </div>
                  </div>
                </div>
              </td>
              <td>
                <code class="text-xs bg-base-200 px-2 py-1 rounded">{{ category.slug }}</code>
              </td>
              <td>
                <span z-if="category.parent_name" class="badge badge-ghost">
                  {{ category.parent_name }}
                </span>
                <span z-else class="text-base-content/50">Root</span>
              </td>
              <td>
                <div 
                  class="badge"
                  :class="category.status === 'active' ? 'badge-success' : 'badge-warning'"
                >
                  {{ category.status }}
                </div>
              </td>
              <td>
                <span class="font-mono text-sm">{{ category.order }}</span>
              </td>
              <td>
                <span class="badge badge-primary badge-outline">
                  {{ category.products_count ?? 0 }}
                </span>
              </td>
              <td>
                <span class="text-sm">{{ formatDate(category.created_at) }}</span>
              </td>
              <td>
                <div class="flex gap-2">
                  <a 
                    :href="'/admin/categories/edit/' + category.id" 
                    class="btn btn-ghost btn-sm"
                    title="Edit"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                  </a>
                  <button 
                    class="btn btn-ghost btn-sm text-error"
                    @click="deleteCategory(category.id, category.name)"
                    title="Delete"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <!-- Empty State -->
        <div z-if="filteredCategories.length === 0" class="text-center py-12">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-base-content/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
          </svg>
          <p class="text-base-content/60 mt-4">No categories found</p>
          <a href="/admin/categories/create" class="btn btn-primary btn-sm mt-4">
            Create your first category
          </a>
        </div>
      </div>

      <!-- Bulk Actions -->
      <div z-if="selectedIds.length > 0" class="flex items-center gap-4 mt-4 p-4 bg-base-200 rounded-lg">
        <span class="text-sm font-medium">
          {{ selectedIds.length }} selected
        </span>
        <div class="flex gap-2">
          <button class="btn btn-sm btn-success" @click="bulkAction('activate')">
            Activate
          </button>
          <button class="btn btn-sm btn-warning" @click="bulkAction('deactivate')">
            Deactivate
          </button>
          <button class="btn btn-sm btn-error" @click="bulkAction('delete')">
            Delete
          </button>
        </div>
      </div>

      <!-- Pagination -->
      <div class="flex justify-between items-center mt-6">
        <div class="text-sm text-base-content/60">
          Showing {{ (currentPage - 1) * perPage + 1 }} to 
          {{ Math.min(currentPage * perPage, totalCategories) }} 
          of {{ totalCategories }} categories
        </div>
        <div class="btn-group">
          <button 
            class="btn btn-sm" 
            :disabled="currentPage === 1"
            @click="previousPage"
          >
            «
          </button>
          <button class="btn btn-sm btn-active">{{ currentPage }}</button>
          <button 
            class="btn btn-sm" 
            :disabled="currentPage >= totalPages"
            @click="nextPage"
          >
            »
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Delete Confirmation Modal -->
<dialog id="delete_modal" class="modal">
  <div class="modal-box">
    <h3 class="font-bold text-lg">Delete Category</h3>
    <p class="py-4">
      Are you sure you want to delete "<span class="font-bold">{{ categoryToDelete.name }}</span>"?
      <span z-if="categoryToDelete.hasChildren" class="text-error block mt-2">
        Warning: This category has sub-categories!
      </span>
    </p>
    <div class="modal-action">
      <button class="btn btn-ghost" @click="closeDeleteModal">Cancel</button>
      <button class="btn btn-error" @click="confirmDelete">Delete</button>
    </div>
  </div>
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>
@endsection