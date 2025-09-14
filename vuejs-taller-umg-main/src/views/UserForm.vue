<template>
  <v-container class="pa-6" max-width="600">
    <v-card>
      <v-card-title>
        <span class="text-h6">Agregar Usuario</span>
      </v-card-title>

      <v-card-text>
        <v-form ref="formRef" v-model="isValid">
          <v-text-field
            v-model="form.nombre"
            label="Nombre"
            :rules="[v => !!v || 'El nombre es obligatorio']"
            required
          />

          <v-text-field
            v-model="form.email"
            label="Email"
            :rules="[v => !!v || 'El email es obligatorio', v => /.+@.+/.test(v) || 'Email inválido']"
            required
          />

          <v-text-field
            v-model="form.password"
            label="Contraseña"
            type="password"
            :rules="[v => !!v || 'La contraseña es obligatoria', v => v.length >= 6 || 'Mínimo 6 caracteres']"
            required
          />

          <v-select
            v-model="form.rol"
            :items="roles"
            label="Rol"
            :rules="[v => !!v || 'Selecciona un rol']"
            required
          />

          <v-alert
            v-if="errorMessage"
            type="error"
            dense
            class="mt-3"
          >
            {{ errorMessage }}
          </v-alert>

          <v-alert
            v-if="successMessage"
            type="success"
            dense
            class="mt-3"
          >
            {{ successMessage }}
          </v-alert>
        </v-form>
      </v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn
          color="primary"
          :disabled="!isValid || isSubmitting"
          @click="submitForm"
        >
          Guardar
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-container>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import axios from 'axios'

const formRef = ref()
const isValid = ref(false)
const isSubmitting = ref(false)

const form = ref({
  nombre: '',
  email: '',
  password: '',
  rol: '',
})

const roles = ['admin', 'usuario']

const errorMessage = ref('')
const successMessage = ref('')

// Tomamos el token del localStorage (debe estar guardado al hacer login)
const token = localStorage.getItem('token')

const submitForm = async () => {
  errorMessage.value = ''
  successMessage.value = ''
  if (!formRef.value.validate()) return

  isSubmitting.value = true

  try {
    const response = await axios.post(
      'http://127.0.0.1:8000/api/usuarios/addUser',
      form.value,
      { headers: { Authorization: `Bearer ${token}` } }
    )
    successMessage.value = response.data.message
    form.value.nombre = ''
    form.value.email = ''
    form.value.password = ''
    form.value.rol = ''
  } catch (error: any) {
    if (error.response?.data?.message) {
      errorMessage.value = error.response.data.message
    } else {
      errorMessage.value = 'Error al crear usuario'
    }
  } finally {
    isSubmitting.value = false
  }
}
</script>
