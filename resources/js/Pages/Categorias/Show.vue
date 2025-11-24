<template>
  <div class="max-w-4xl mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6 border-b pb-2">Detalle Categoría: {{ categoria.nombre }}</h1>
    <div class="bg-white p-6 rounded shadow mb-8">
      <p class="mb-2"><strong class="font-semibold">ID:</strong> {{ categoria.id }}</p>
      <p class="mb-2"><strong class="font-semibold">Nombre:</strong> {{ categoria.nombre }}</p>
      <p class="mb-2">
        <strong class="font-semibold">Estado:</strong>
        <span :class="categoria.estado ? 'text-green-600 font-semibold' : 'text-red-500 font-semibold'">
          {{ categoria.estado ? 'Activo' : 'Inactivo' }}
        </span>
      </p>
      <p class="mb-2"><strong class="font-semibold">Descripción:</strong> {{ categoria.descripcion }}</p>
      <p class="mb-2"><strong class="font-semibold">Prioridad:</strong> {{ categoria.prioridad }}</p>
      <p><strong class="font-semibold">Fecha Creación:</strong> {{ new Date(categoria.fecha_creacion).toLocaleString() }}</p>
    </div>

    <h2 class="text-xl font-semibold mb-4 border-b pb-2">Registros relacionados (Phones)</h2>
    <table class="w-full bg-white shadow rounded">
      <thead>
        <tr class="bg-gray-100 text-left">
          <th class="py-2 px-4">ID</th>
          <th class="py-2 px-4">Modelo</th>
          <th class="py-2 px-4">Marca</th>
          <th class="py-2 px-4">Precio</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="phone in categoria.phones" :key="phone.id" class="border-b">
          <td class="py-2 px-4">{{ phone.id }}</td>
          <td class="py-2 px-4">{{ phone.modelo }}</td>
          <td class="py-2 px-4">{{ phone.marca }}</td>
          <td class="py-2 px-4">{{ phone.precio }}</td>
        </tr>
        <tr v-if="!categoria.phones.length">
          <td class="py-2 px-4 text-center" colspan="4">No hay registros relacionados.</td>
        </tr>
      </tbody>
    </table>

    <div class="mt-6">
      <a href="/categories" class="text-blue-700 hover:underline font-semibold">Volver al listado</a>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  categoria: Object,
})
</script>
