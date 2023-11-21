<script setup lang="ts">
import type { IAttachPayPeriodBudgetRequest } from '~/http/requests/budgets.request';
import type { IBudgetResource } from '~/http/resources/budgets.resource';

const accountStore = useAccountStore();
const budgetStore = useBudgetStore();
const modalStore = useModalStore();

onMounted(async () => {
  await budgetStore.getBudgets();
});

const budgetOptions = computed(() => {
  return budgetStore.budgets.map((budget: IBudgetResource) => {
    return {
      label: `${budget.name} - ${budget.amount.pretty}`,
      value: budget.id,
    };
  });
});

const selectedBudget: Ref<number> = ref(0);

const form: IAttachPayPeriodBudgetRequest = reactive({
  total_balance: 0,
});

const errors = ref();

const handleSubmit = async () => {
  form.total_balance = form.total_balance * 100;

  const response = await useNuxtApp().$api.budgets.attachBudgetToPayPeriod(
    accountStore.user.pay_period.id,
    selectedBudget.value,
    form
  );

  if (!(errors.value = response.errors)) {
    modalStore.closePeriodModal();
    await budgetStore.getPayPeriodBudgets(accountStore.user.pay_period.id);
  }
};
</script>

<template>
  <div>
    <UForm :state="form" class="space-y-4" @submit="handleSubmit">
      <h4 class="text-xl font-bold text-rose-500">Attach Budget</h4>
      <p class="text-sm font-light">
        Attach on of your Budgets to the currently selected Pay Period
      </p>
      <UFormGroup label="Budget" name="budget_id">
        <USelect v-model="selectedBudget" :options="budgetOptions" />
      </UFormGroup>
      <UFormGroup label="Total Balance" name="total_balance">
        <UInput v-model="form.total_balance" />
      </UFormGroup>
      <UButton type="submit" color="rose"> Attach </UButton>
      <FormsFormErrors :errors="errors" />
    </UForm>
  </div>
</template>
