#!/bin/bash

# $ script/run.sh <your command>
# EG:
# $ script/run.sh yarn add lodash

docker run --rm -v $(pwd)/src:/app "$@"