<template>
  <div class="max-w-lg mx-auto py-8">
    <h2 class="text-xl font-semibold mb-6">Editar Teléfono</h2>
    <form @submit.prevent="submit" class="space-y-4">
      <div>
        <label class="block mb-1 font-medium">Marca:</label>
        <input v-model="form.phone_brand" type="text" class="border rounded px-3 py-1 w-full" />
        <span v-if="errors.phone_brand" class="text-red-500 text-xs">{{ errors.phone_brand }}</span>
      </div>
      <div>
        <label class="block mb-1 font-medium">Modelo:</label>
        <input v-model="form.phone_model" type="text" class="border rounded px-3 py-1 w-full" />
        <span v-if="errors.phone_model" class="text-red-500 text-xs">{{ errors.phone_model }}</span>
      </div>
      <div>
        <label class="block mb-1 font-medium">Precio:</label>
        <input v-model="form.phone_price" type="number" min="0" step="0.01" class="border rounded px-3 py-1 w-full" />
        <span v-if="errors.phone_price" class="text-red-500 text-xs">{{ errors.phone_price }}</span>
      </div>
      <div>
        <label class="block mb-1 font-medium">Tamaño pantalla (pulgadas):</label>
        <input v-model="form.phone_display_size" type="number" min="1" max="10" class="border rounded px-3 py-1 w-full" />
        <span v-if="errors.phone_display_size" class="text-red-500 text-xs">{{ errors.phone_display_size }}</span>
      </div>
      <div>
        <label class="block mb-1 font-medium">¿Es Smartphone?</label>
        <select v-model="form.phone_is_smartphone" class="border rounded px-3 py-1 w-full">
          <option :value="true">Sí</option>
          <option :value="false">No</option>
        </select>
        <span v-if="errors.phone_is_smartphone" class="text-red-500 text-xs">{{ errors.phone_is_smartphone }}</span>
      </div>
      <div>
        <label class="block mb-1 font-medium">Categoría:</label>
        <select v-model="form.categoria_id" class="border rounded px-3 py-1 w-full">
          <option :value="null">Sin categoría</option>
          <option v-for="cat in categorias" :key="cat.id" :value="cat.id">{{ cat.nombre }}</option>
        </select>
        <span v-if="errors.categoria_id" class="text-red-500 text-xs">{{ errors.categoria_id }}</span>
      </div>
      <div>
        <label class="block mb-1 font-medium">Código de barras (opcional):</label>
        <input v-model="form.codigo_barras" type="text" class="border rounded px-3 py-1 w-full" />
        <span v-if="errors.codigo_barras" class="text-red-500 text-xs">{{ errors.codigo_barras }}</span>
      </div>
      <div class="flex flex-row gap-4 items-center">
        <button type="submit" class="bg-blue-600 text-white font-semibold px-4 py-2 rounded">Guardar Cambios</button>
        <span v-if="success" class="text-green-500 text-sm ml-2">{{ success }}</span>
        <button type="button" class="bg-gray-400 text-white font-semibold px-4 py-2 rounded" @click="goBack">Regresar</button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { reactive, ref } from 'vue'
import { router, usePage } from '@inertiajs/vue3'

const page = usePage()
const phone = page.props.phone
const categorias = page.props.categorias || []

const form = reactive({
  phone_brand: phone.phone_brand,
  phone_model: phone.phone_model,
  phone_price: phone.phone_price,
  phone_display_size: phone.phone_display_size,
  phone_is_smartphone: phone.phone_is_smartphone,
  categoria_id: phone.categoria_id,
  codigo_barras: phone.codigo_barras,
})

const errors = ref({})
const success = ref(page.props.flash?.success || '')

function submit() {
  errors.value = {}
  router.put(`/phones/${phone.id_phone}`, form, {
    onError: (err) => errors.value = err,
    // No agregar router.visit, solo notificación si quieres
  })
}

// Botón para regresar al listado
function goBack() {
  router.visit('/phones')
}
</script>
