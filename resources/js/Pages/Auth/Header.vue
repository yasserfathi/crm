<template>
  <v-app-bar color="primary">
            <v-container class="pt-2 fill-height d-flex align-center">
                <v-menu>
                    <template v-slot:activator="{ props }">
                        <v-btn icon="mdi-dots-vertical" v-bind="props">
                            <v-avatar>
                                <v-icon color="white" icon="mdi-account-circle" size="x-large"></v-icon>
                            </v-avatar>
                        </v-btn>
                    </template>

                    <v-list dense>
                        <v-list-item @click="$inertia.post('/logout')">
                            <v-list-item-title> <v-icon>mdi-logout</v-icon>Sign Out </v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-menu>
                Adminstrator
                <v-row no-gutters>
                    <v-col cols="12">
                        <p class="text-right text-h6">
                            CRM Demo
                        </p>
                    </v-col>
                </v-row>
                <v-spacer></v-spacer>
                <v-btn @click="toggleTheme" variant="flat" rounded="pill" color="white" size="25">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M12 22c5.52 0 10-4.48 10-10S17.52 2 12 2S2 6.48 2 12s4.48 10 10 10zm1-17.93c3.94.49 7 3.85 7 7.93s-3.05 7.44-7 7.93V4.07z" />
                    </svg>
                </v-btn>
            </v-container>
        </v-app-bar>
</template>
<script>
import { useTheme } from 'vuetify'
export default {
  data() {
    return {}
  },
  setup() {
        const theme = useTheme()
        return {
            theme,
            toggleTheme: () => theme.global.name.value = theme.global.current.value.dark ? 'light' : 'dark'
        }
    },
}
</script>