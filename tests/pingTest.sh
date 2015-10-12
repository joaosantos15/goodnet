#! /bin/bash

count = 100                            # Maximum number to try.
while [[ $count -ne 0 ]] ; do
    ping -c 1 $1                      # Try once.
    rc=$?
    if [[ $rc -eq 0 ]] ; then
        ((count = 1))                      # If okay, flag to exit loop.
    fi
    ((count = count - 1))                  # So we don't go forever.
done

if [[ $rc -eq 0 ]] ; then                  # Make final determination.
    echo "gateway 0"
else
    echo "gateway 1"
fi

count2 = 100                            # Maximum number to try.
while [[ $count2 -ne 0 ]] ; do
    ping -c 1 $2                      # Try once.
    rc=$?
    if [[ $rc -eq 0 ]] ; then
        ((count2 = 1))                      # If okay, flag to exit lo$
    fi
    ((count2 = count2 - 1))                  # So we don't go forever.
done

if [[ $rc -eq 0 ]] ; then                  # Make final determination.
    echo "pubip 0"
else
    echo "pubip 1"
fi

count3 = 100                            # Maximum number to try.
while [[ $count3 -ne 0 ]] ; do
    ping -c 8.8.8.8                      # Try once.
    rc=$?
    if [[ $rc -eq 0 ]] ; then
        ((count3 = 1))                      # If okay, flag to exit lo$
    fi
    ((count3 = count3 - 1))                  # So we don't go forever.
done

if [[ $rc -eq 0 ]] ; then                  # Make final determination.
    echo "internet 0"
else
    echo "internet 1"
fi

