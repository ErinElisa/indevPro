// index.test.js
import { test } from 'node:test';
import assert from 'node:assert';
import { sum } from './index.js'; // Adjust the path if necessary

test('sum tambah dua bilangan positif dengan benar', () => {
  assert.strictEqual(sum(1, 2), 3, '1 + 2 harus bernilai 3');
});

test('sum tambah bilangan positif dan negatif dengan benar', () => {
  assert.strictEqual(sum(-1, 1), 0, '-1 + 1 harus bernilai 0');
});

test('sum tambah dua bilangan negatif dengan benar', () => {
  assert.strictEqual(sum(-1, -1), -2, '-1 + -1 harus bernilai -2');
});

test('sum tambah 2 nol dengan benar', () => {
  assert.strictEqual(sum(0, 0), 0, '0 + 0 harus bernilai 0');
});

test('sum tambah angka dan nol dengan benar', () => {
  assert.strictEqual(sum(5, 0), 5, '5 + 0 harus bernilai 5');
});
