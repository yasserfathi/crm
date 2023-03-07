<template>
  <Head title="Dashboard " />
  <v-app id="inspire">
    <Header />

    <v-main class="bg-grey-lighten-3">
      <v-container>
        <v-row>
          <v-col cols="3">
            <Menu />
          </v-col>

          <v-col>
            <v-sheet min-height="45vh" rounded="lg">
                <v-container>
                  <v-row>
                    
                    <v-col
                      cols="6"
                      class="mt-10"
                  >
                  <v-card
                      card-title="Title"
                      class="mx-auto text-h4"
                      height="150"
                  >
                  <template v-slot:title>
                    <h3 class="display-4 text-primary">Customers</h3>
                  </template>
                  <v-divider></v-divider>
                  <v-card-text class="">
                    <v-row align="center" no-gutters>
                      <v-col cols="6" class="text-left">
                        <v-icon
                          icon="mdi-account-multiple"
                          size="50"
                          color="primary"
                        ></v-icon>
                      </v-col>
                      <v-col
                        class="text-h5"
                        cols="6"
                      >
                       {{customers}}
                      </v-col>
                    </v-row>
                  </v-card-text>
                  </v-card>
                  </v-col>

                  <v-col
                      cols="6"
                      class="mt-10"
                  >
                  <v-card
                      card-title="Title"
                      class="mx-auto text-h4"
                      height="150"
                  >
                  <template v-slot:title>
                    <h3 class="display-4 text-primary">Salesman</h3>
                  </template>
                  <v-divider></v-divider>
                  <v-card-text class="">
                    <v-row align="center" no-gutters>
                      <v-col cols="6" class="text-left">
                        <v-icon
                          icon="mdi-account-multiple-outline"
                          size="50"
                          color="primary"
                        ></v-icon>
                      </v-col>
                      <v-col
                        class="text-h5"
                        cols="6"
                      >
                        {{salesmen}}
                      </v-col>
                    </v-row>
                  </v-card-text>
                  </v-card>
                  </v-col>

                  
                  </v-row>

                  <v-row>
                    
                    <v-col
                      cols="6"
                      class="mt-10"
                  >
                  <v-card
                      card-title="Title"
                      class="mx-auto text-h4"
                      height="150"
                  >
                  <template v-slot:title>
                    <h3 class="display-4 text-primary">Products</h3>
                  </template>
                  <v-divider></v-divider>
                  <v-card-text class="">
                    <v-row align="center" no-gutters>
                      <v-col cols="6" class="text-left">
                        <v-icon
                          icon="mdi-cube"
                          size="50"
                          color="primary"
                        ></v-icon>
                      </v-col>
                      <v-col
                        class="text-h5"
                        cols="6"
                      >
                        {{products}}
                      </v-col>
                    </v-row>
                  </v-card-text>
                  </v-card>
                  </v-col>

                  <v-col
                      cols="6"
                      class="mt-10"
                  >
                  <v-card
                      card-title="Title"
                      class="mx-auto text-h4"
                      height="150"
                  >
                  <template v-slot:title>
                    <h3 class="display-4 text-primary">Services</h3>
                  </template>
                  <v-divider></v-divider>
                  <v-card-text class="">
                    <v-row align="center" no-gutters>
                      <v-col cols="6" class="text-left">
                        <v-icon
                          icon="mdi-cube-outline"
                          size="50"
                          color="primary"
                        ></v-icon>
                      </v-col>
                      <v-col
                        class="text-h5"
                        cols="6"
                      >
                        {{services}}
                      </v-col>
                    </v-row>
                  </v-card-text>
                  </v-card>
                  </v-col>

                  
                  </v-row>
                </v-container>
            </v-sheet>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import { Head,useForm  } from '@inertiajs/vue3';
import { useTheme } from 'vuetify'
import Header from './Header.vue';
import Menu from './Menu.vue';
export default {
  props:{
        customers: Number,
        salesmen: Number,
        products: Number,
        services: Number,
    },
  setup () {
    const theme = useTheme()

    return {
      theme,
      toggleTheme: () => theme.global.name.value = theme.global.current.value.dark ? 'light' : 'dark'
    }
  },
  components: {
    Head,
    Header,
    Menu
   }
};
</script>