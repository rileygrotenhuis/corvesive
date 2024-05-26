<script setup>
import useStore from '@/store/store';

const store = useStore();
</script>

<template>
  <div class="text-center">
    <button
      :class="`rounded-l-xl border border-slate-500 px-4 py-2 text-sm font-bold shadow-lg ${
        store.expenseType === 'budgets' ? 'bg-slate-300' : 'bg-slate-100'
      } w-24 hover:bg-slate-300 sm:w-32`"
      @click.prevent="store.setExpenseType('budgets')"
    >
      Budgets
    </button>
    <button
      :class="`border border-slate-500 px-4 py-2 text-sm font-bold shadow-lg ${
        store.expenseType === 'bills' ? 'bg-slate-300' : 'bg-slate-100'
      } w-24 hover:bg-slate-300 sm:w-32`"
      @click.prevent="store.setExpenseType('bills')"
    >
      Bills
    </button>
    <button
      :class="`rounded-r-xl border border-slate-500 px-4 py-2 text-sm font-bold shadow-lg ${
        store.expenseType === 'savings' ? 'bg-slate-300' : 'bg-slate-100'
      } w-24 hover:bg-slate-300 sm:w-32`"
      @click.prevent="store.setExpenseType('savings')"
    >
      Savings
    </button>
  </div>
</template>
