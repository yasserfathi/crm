<template>
<v-sheet rounded="lg">
                            <v-list>
                                <v-list-item prepend-icon="mdi-menu" title="Main Menu"></v-list-item>

                                <v-list-item v-for="(item, i) in items" :key="i" :value="item" active-color="primary"  @click="$inertia.get(item.to)">
                                    <template v-slot:prepend>
                                        <v-icon :icon="item.icon"></v-icon>
                                    </template>

                                    <v-list-item-title v-text="item.text"></v-list-item-title>
                                </v-list-item>
                                <v-list-item active-color="primary"  @click="$inertia.post('/logout')">
                                    <template v-slot:prepend>
                                        <v-icon icon="mdi-logout"></v-icon>
                                    </template>

                                    <v-list-item-title>Sign out</v-list-item-title>
                                </v-list-item>
                            </v-list>
                        </v-sheet>
</template>
<script>
export default {
    props:{
        services:Array,
    },
    data: () => ({
        items: [
            { text: "Dashboard", icon: "mdi-view-dashboard",to: "/dashboard" },
            { text: "Customers", icon: "mdi-account-multiple",to: "/customer" },
            { text: "Salesmen", icon: "mdi-account-multiple-outline",to: "/salesman" },
            { text: "Products", icon: "mdi-cube",to: "/product" },
            { text: "Services", icon: "mdi-cube-outline",to: "/service" },
        ],
        nameRules: [ (v) => !!v || "Name is required",],
    }),
  }
</script>