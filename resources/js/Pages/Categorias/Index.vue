<template>
  <div class="max-w-4xl mx-auto py-8">
    <div class="flex justify-between mb-4">
      <h1 class="text-2xl font-bold">Categorías</h1>
      <a
        href="/categories/create"
        class="bg-green-600 text-white px-4 py-2 rounded font-semibold"
      >Nueva Categoría</a>
    </div>
    <form @submit.prevent="searchCategorias" class="mb-4 flex gap-2">
      <input
        v-model="search"
        placeholder="Buscar por nombre"
        type="text"
        class="border rounded px-3 py-1 w-full"
      />
      <button type="submit" class="bg-blue-600 text-white font-semibold px-4 py-1 rounded">
        Buscar
      </button>
    </form>
    <table class="w-full bg-white shadow rounded">
      <thead>
        <tr class="bg-gray-100 text-left">
          <th class="py-2 px-4">ID</th>
          <th class="py-2 px-4">Nombre</th>
          <th class="py-2 px-4">Estado</th>
          <th class="py-2 px-4">Descripción</th>
          <th class="py-2 px-4">Prioridad</th>
          <th class="py-2 px-4">Total Teléfonos</th> <!-- NUEVA COLUMNA -->
          <th class="py-2 px-4">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="cat in categories.data" :key="cat.id" class="border-b">
          <td class="py-2 px-4">{{ cat.id }}</td>
          <td class="py-2 px-4">{{ cat.nombre }}</td>
          <td class="py-2 px-4">{{ cat.estado ? 'Activo' : 'Inactivo' }}</td>
          <td class="py-2 px-4">{{ cat.descripcion }}</td>
          <td class="py-2 px-4">{{ cat.prioridad }}</td>
          <td class="py-2 px-4">{{ cat.phones_count }}</td> <!-- CAMPO CONTEO -->
          <td class="py-2 px-4 flex gap-2">
            <a
              :href="`/categories/${cat.id}`"
              class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm font-small"
            >Ver detalle</a>
            <a
              :href="`/categories/${cat.id}/edit`"
              class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm font-small"
            >Editar</a>
            <button
              @click="confirmDelete(cat.id)"
              class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm font-small"
            >Eliminar</button>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="flex justify-between mt-4">
      <button
        :disabled="!categories.prev_page_url"
        @click="paginate(categories.prev_page_url)"
        class="px-4 py-2 rounded bg-gray-300 font-medium disabled:opacity-50">
        Anterior
      </button>
      <button
        :disabled="!categories.next_page_url"
        @click="paginate(categories.next_page_url)"
        class="px-4 py-2 rounded bg-blue-500 text-white font-medium disabled:opacity-50">
        Siguiente
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  categories: Object,
  filters: Object,
})

const search = ref(props.filters.search || '')

function searchCategorias() {
  router.get('/categories', { search: search.value }, { preserveState: true, replace: true })
}

function paginate(url) {
  router.visit(url, { preserveState: true, replace: true })
}

// Confirmación y eliminación de categoría
function confirmDelete(id) {
  if (confirm('¿Estás seguro de eliminar esta categoría?')) {
    router.delete(`/categories/${id}`, {
      onSuccess: () => {
        // Opcional: puedes mostrar un toast o refrescar datos automáticamente
      },
    })
  }
}
</script>
