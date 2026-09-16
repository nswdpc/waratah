#!/usr/bin/env bash
BUN=`which bun`

if ! [ -x "$(command -v $BUN)" ]; then
  echo 'Error: bun is not installed on host' >&2
  exit 1
fi

BUILD_SCRIPT=$(readlink -f "$0")
BUILD_SCRIPT_DIR=$(dirname "$BUILD_SCRIPT")
PREFIX="${BUILD_SCRIPT_DIR}/themes/nswds/app/frontend/"

echo "Building the NSW Design System frontend using Bun"
echo "Bun: $BUN"
echo "Prefix: $PREFIX"

echo "Target: buildall"
$BUN run --cwd $PREFIX buildall

echo "Completed the NSW Design System frontend build using Bun"
