<template>
    <Head title="Login Page " />
    <v-app id="bg">
      <v-main>
        <v-container class="mt-16">
          <v-card class="mx-auto mt-16" width="585">
            <v-form ref="form" fast-fail @submit.prevent>
              <v-card-text>
                <div class="mx-auto layout column align-center">
                  <p class="text-center text-h5">
                    CRM Demo
                    <v-avatar color="primary mx-auto text-h6">
                      <v-icon color="white" icon="mdi-account-group" class="font-weight-black"></v-icon>
                    </v-avatar>
                  </p>
                </div>
                <v-divider class="my-5 border-opacity-100"></v-divider>
                <v-alert v-if="this.error != ''" closable text="your email or password was incorrect. please try again" type="error" variant="tonal"></v-alert>
                <v-text-field
                  name="email"
                  hint="E-mail"
                  autocomplete="new-password"
                  placeholder="E-mail"
                  prepend-icon="mdi-account"
                  variant="underlined"
                  v-model="loginForm.email"
                  :rules="emailRules"
                  @keydown.enter="submit"
                  required
                ></v-text-field>

                <v-text-field
                  id="password"
                  name="password"
                  variant="underlined"
                  prepend-icon="mdi-lock"
                  :type="showpassword ? 'text' : 'password'"
                  v-model="loginForm.password"
                  :rules="passwordRules"
                  autocomplete="new-password"
                  placeholder="Password"
                  @click:append="showpassword = !showpassword"
                  @keydown.enter="submit"
                ></v-text-field>
                <v-checkbox name="remember" label="Remember me" class="py-0 mt-0" v-model:checked="loginForm.remember"></v-checkbox>
                <v-btn
                  color="primary"
                  variant="flat"
                  block
                  @click="submit"
                  :loading="loading"
                  class="py-0"
                  :disabled="loginForm.processing"
                  >Sign in
                </v-btn>
              </v-card-text>
            </v-form>
          </v-card>
        </v-container>
      </v-main>
    </v-app>
  </template>

<script>
import { Head,useForm  } from '@inertiajs/vue3';

export default {
data: () => ({
    showpassword: false,
    loading: false,
    chksave: true,
    valid: false,
    error:"",
    emailRules: [ v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid' ],
    passwordRules: [
      (v) => !!v || "Password is required",
      (v) => (v && v.length >= 6) || "password must be at least 6 characters",
    ],
  }),
  components: {
        Head
    },
  setup (){
    const loginForm = useForm({
        email: 'admin@crm.com',
        password: '12345678',
        remember: false,
    });
    return { loginForm }
  },
  methods: {
    async submit() {
        const { valid } = await this.$refs.form.validate()
        if (valid){
            this.error = "";
            this.loginForm.post(route('login'), {
                preserveScroll: true,
                onSuccess: () => this.loginForm.reset('password'),
                onError: (response) => {
                    this.error = response.email;
                },
                onFinish: () => this.loginForm.reset(),
            });
        }
    },
  },
}
</script>
<style scoped lang="css">
  #bg {
    background-color: rgb(249, 245, 245);
  }
  </style>
