<template>
  <div class="max-w-5xl mx-auto py-8">
    <div class="flex justify-between mb-4">
      <h1 class="text-2xl font-bold">Listado de Teléfonos</h1>
      <a
        href="/phones/create"
        class="bg-green-600 text-white px-4 py-2 rounded font-semibold"
      >Nuevo Teléfono</a>
    </div>
    <form @submit.prevent="searchPhones" class="mb-4 flex gap-2">
      <input
        v-model="search"
        placeholder="Buscar por modelo o marca"
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
          <th class="py-2 px-4">Marca</th>
          <th class="py-2 px-4">Modelo</th>
          <th class="py-2 px-4">Precio</th>
          <th class="py-2 px-4">Smartphone</th>
          <th class="py-2 px-4">Categoría</th>
          <th class="py-2 px-4">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="phone in phones.data" :key="phone.id_phone" class="border-b">
          <td class="py-2 px-4">{{ phone.id_phone }}</td>
          <td class="py-2 px-4">{{ phone.phone_brand }}</td>
          <td class="py-2 px-4">{{ phone.phone_model }}</td>
          <td class="py-2 px-4">{{ phone.phone_price }}</td>
          <td class="py-2 px-4">
            <span :class="phone.phone_is_smartphone ? 'text-green-600 font-semibold' : 'text-gray-500'">
              {{ phone.phone_is_smartphone ? 'Sí' : 'No' }}
            </span>
          </td>
          <td class="py-2 px-4">{{ phone.categoria ? phone.categoria.nombre : 'Sin categoría' }}</td>
          <td class="py-2 px-4 flex gap-2">
            <a
              :href="`/phones/${phone.id_phone}`"
              class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm font-medium"
            >Ver detalle</a>
            <a
              :href="`/phones/${phone.id_phone}/edit`"
              class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm font-medium"
            >Editar</a>
            <button
              @click="confirmDelete(phone.id_phone)"
              class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm font-medium"
            >Eliminar</button>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="flex justify-between mt-4">
      <button
        :disabled="!phones.prev_page_url"
        @click="paginate(phones.prev_page_url)"
        class="px-4 py-2 rounded bg-gray-300 font-medium disabled:opacity-50">
        Anterior
      </button>
      <button
        :disabled="!phones.next_page_url"
        @click="paginate(phones.next_page_url)"
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
  phones: Object,
  filters: Object,
})

const search = ref(props.filters.search || '')

function searchPhones() {
  router.get('/phones', { search: search.value }, { preserveState: true, replace: true })
}

function paginate(url) {
  router.visit(url, { preserveState: true, replace: true })
}

function confirmDelete(id) {
  if (confirm('¿Estás seguro de eliminar este teléfono?')) {
    router.delete(`/phones/${id}`, {
      preserveScroll: true,
      onSuccess: () => {
        // No agregar router.visit, solo mensaje si usas toast
      },
    });
  }
}

</script>
