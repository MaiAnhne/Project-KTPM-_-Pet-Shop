import { test, expect } from '@playwright/test';

test('Mở trang chủ', async ({ page }) => {
    await page.goto('/');

    await expect(page).toHaveURL('http://127.0.0.1:8000/');
});